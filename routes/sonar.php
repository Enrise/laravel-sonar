<?php

declare(strict_types=1);

use Enrise\LaravelSonar\Infrastructure\Actions\DashboardAction;
use Enrise\LaravelSonar\Infrastructure\Actions\TransactionResolveAction;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardAction::class);
Route::post('/transactions/resolve', TransactionResolveAction::class);