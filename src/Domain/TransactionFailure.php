<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class TransactionFailure
{
    public function __construct(
        public readonly int $id,
        public readonly int $transactionId,
        public readonly string $message,
        public readonly bool $isResolved,
    ) {
    }
}
