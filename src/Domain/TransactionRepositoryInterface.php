<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

interface TransactionRepositoryInterface
{
    public function find(int $id): ?Transaction;

    public function store(Transaction $transaction): void;
}
