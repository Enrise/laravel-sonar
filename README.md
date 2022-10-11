## Sonar

Ever wanted to track command executions, notifications and events? Use Laravel Sonar today!

## Getting started

`composer require enrise/laravel-sonar`

`php artisan vendor:publish --provider=Enrise\\LaravelSonar\\Infrastructure\\ServiceProviders\\LaravelSonarServiceProvider --tag=config`

Add the sonar routes to the route group of your choosing

in `routes/web.php`
```php
    Route::prefix('/sonar')->group(function() {
        Route::get('/', \Enrise\LaravelSonar\Infrastructure\Actions\DashboardAction::class);
        Route::post('/transactions/resolve', \Enrise\LaravelSonar\Infrastructure\Actions\TransactionResolveAction::class);
    });
```

Run `php artisan serve`

View the dashboard on `http://localhost:8080/sonar`
