<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\Repositories;

use Enrise\LaravelSonar\Domain\Entities\TransactionFailure;

interface TransactionFailureRepositoryInterface
{
    public function find(int $id): TransactionFailure;

    public function store(TransactionFailure $transactionFailure): void;
}
