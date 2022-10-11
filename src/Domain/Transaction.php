<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class Transaction
{
    public function __construct(
        public readonly string $id,
        public readonly TransactionType $type,
        public readonly string $class,
        public readonly TransactionDateTime $started,
        public readonly TransactionDateTime $finished,
    ) {
    }
}
