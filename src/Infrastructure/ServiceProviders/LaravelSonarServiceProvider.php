<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\ServiceProviders;

use Enrise\LaravelSonar\Application\Services\CurrentTransactionStack;
use Enrise\LaravelSonar\Application\Services\TransactionService;
use Enrise\LaravelSonar\Application\Services\TransactionServiceInterface;
use Enrise\LaravelSonar\Domain\Repositories\CurrentTransactionStackInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionRepositoryInterface;
use Enrise\LaravelSonar\Infrastructure\EventListeners\CommandEventSubscriber;
use Enrise\LaravelSonar\Infrastructure\Repositories\TransactionFailureRepository;
use Enrise\LaravelSonar\Infrastructure\Repositories\TransactionRepository;
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

        Event::subscribe(CommandEventSubscriber::class);
    }
}
