![logo](./github/logo.png)

## Sonar

Ever wanted to track command executions, notifications and events? Use Laravel Sonar today!

The best developer is the one that can sleep easily at night.
With Sonar, you can rest easily (or at least know why you have nightmares) that your notifications reach your users and your commands reach the scheduler.
So in short, that which can be invisible during an acceptance test is being monitored for you:

* When a command succeeds
* When a command fails
* When a notification succeeds
* When a notification fails

And it comes with a fancy dashboard as well!

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
