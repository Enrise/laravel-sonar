<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application;

use Enrise\LaravelSonar\Domain\Transaction;

interface TransactionServiceInterface
{
    public function start(): Transaction;
    public function succeed(Transaction $transaction): void;
    public function fail(Transaction $transaction, string $message): void;
}
