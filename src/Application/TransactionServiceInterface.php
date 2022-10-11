<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application;

use Enrise\LaravelSonar\Domain\Transaction;
use Enrise\LaravelSonar\Domain\TransactionType;

interface TransactionServiceInterface
{
    public function current(): Transaction;

    public function start(TransactionType $type, string $class, array $context): Transaction;

    public function succeed(Transaction $transaction): void;

    public function fail(Transaction $transaction, string $message): void;
}
