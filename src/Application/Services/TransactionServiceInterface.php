<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application\Services;

use Enrise\LaravelSonar\Domain\Entities\Transaction;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionType;

interface TransactionServiceInterface
{
    public function current(): Transaction;

    public function start(TransactionType $type, string $class, array $context): Transaction;

    public function succeed(Transaction $transaction): void;

    public function fail(Transaction $transaction, string $message): void;
}
