<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

interface TransactionFailureRepositoryInterface
{
    public function find(int $id): ?TransactionFailure;

    public function store(TransactionFailure $transactionFailure): void;
}
