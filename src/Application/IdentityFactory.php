<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application;

use Illuminate\Support\Str;

final class IdentityFactory
{
    public static function create(): string
    {
        return strtolower((string) Str::ulid());
    }
}
