<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

interface TransactionRepositoryInterface
{
    public function find(TransactionId $id): ?Transaction;

    public function store(Transaction $transaction): void;

    public function updateFinishedAt(Transaction $transaction, TransactionDateTime $finished): void;
}
