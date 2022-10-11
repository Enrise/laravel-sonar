<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\ServiceProviders;

use Enrise\LaravelSonar\Infrastructure\View\Components\BadgeError;
use Enrise\LaravelSonar\Infrastructure\View\Components\BadgeInfo;
use Enrise\LaravelSonar\Infrastructure\View\Components\BadgeSuccess;
use Enrise\LaravelSonar\Infrastructure\View\Components\BadgeWarning;
use Enrise\LaravelSonar\Infrastructure\View\Components\TableTransactions;
use Enrise\LaravelSonar\Application\Services\CurrentTransactionStack;
use Enrise\LaravelSonar\Application\Services\TransactionService;
use Enrise\LaravelSonar\Application\Services\TransactionServiceInterface;
use Enrise\LaravelSonar\Domain\Repositories\CurrentTransactionStackInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionRepositoryInterface;
use Enrise\LaravelSonar\Infrastructure\EventListeners\CommandEventSubscriber;
use Enrise\LaravelSonar\Infrastructure\EventListeners\NotificationEventSubscriber;
use Enrise\LaravelSonar\Infrastructure\Repositories\TransactionFailureRepository;
use Enrise\LaravelSonar\Infrastructure\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class LaravelSonarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        Route::macro('sonar', static function (): void {
            Route::group(__DIR__ . '/../../../routes/sonar.php');
        });

        $this->loadViewsFrom(__DIR__ . '/../../../resources/views', 'laravel-sonar');
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../../config/laravel-sonar.php' => config_path('laravel-sonar.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../../resources/views' => resource_path('views/vendor/laravel-sonar'),
            ], 'views');
        }

        Blade::component('sonar.badge.error', BadgeError::class);
        Blade::component('sonar.badge.success', BadgeSuccess::class);
        Blade::component('sonar.badge.warning', BadgeWarning::class);
        Blade::component('sonar.badge.info', BadgeInfo::class);
        Blade::component('sonar.table.transactions', TableTransactions::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../../config/laravel-sonar.php', 'laravel-sonar');

        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(TransactionFailureRepositoryInterface::class, TransactionFailureRepository::class);

        $this->app->singleton(CurrentTransactionStackInterface::class, CurrentTransactionStack::class);

        $this->app->bind(CommandEventSubscriber::class, static function () {
            return new CommandEventSubscriber(
                resolve(TransactionServiceInterface::class),
                config('laravel-sonar.commands'),
            );
        });

        Event::subscribe(CommandEventSubscriber::class);
        Event::subscribe(NotificationEventSubscriber::class);
    }
}
