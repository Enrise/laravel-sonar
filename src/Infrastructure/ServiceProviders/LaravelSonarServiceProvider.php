<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\ServiceProviders;

use Enrise\LaravelSonar\Infrastructure\EventListeners\CommandEventSubscriber;
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
            Route::group(base_path('routes/sonar.php'));
        });

         $this->loadViewsFrom(__DIR__.'/../../resources/views', 'laravel-sonar');
         $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('laravel-sonar.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/laravel-sonar'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-sonar'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-sonar'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-sonar');

        Event::subscribe(CommandEventSubscriber::class);
    }
}
