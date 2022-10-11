<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class Transaction
{
    public function __construct(
        public readonly int $id,
    ) {
    }
}
