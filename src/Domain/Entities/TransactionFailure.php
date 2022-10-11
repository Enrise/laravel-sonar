<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\Entities;

use Enrise\LaravelSonar\Domain\ValueObjects\TransactionId;

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
