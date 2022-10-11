<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class TransactionFailure
{
    public function __construct(
        public readonly TransactionId $id,
        public readonly TransactionId $transactionId,
        public readonly string $message,
        public readonly bool $isResolved,
    ) {
    }
}
