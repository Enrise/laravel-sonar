<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\Repositories;

use Enrise\LaravelSonar\Domain\Entities\Transaction;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionId;

interface TransactionRepositoryInterface
{
    public function find(TransactionId $id): Transaction;

    public function store(Transaction $transaction): void;
}
