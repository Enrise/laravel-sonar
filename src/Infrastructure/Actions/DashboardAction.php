<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Actions;

final class DashboardAction
{
    public function __invoke()
    {
        return view('laravel-sonar::index');
    }
}
