<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Actions;

use Illuminate\Http\Response;

final class TransactionResolveAction
{
    public function __invoke(): Response
    {
        return response()->noContent();
    }
}
