<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class TransactionFailure
{
    public function __construct(
        public readonly string $id,
        public readonly string $transactionId,
        public readonly string $message,
        public readonly bool $isResolved,
    ) {
    }
}
