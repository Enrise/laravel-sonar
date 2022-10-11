<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Repositories;

use Enrise\LaravelSonar\Domain\Transaction;
use Enrise\LaravelSonar\Domain\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function find(int $id): ?Transaction
    {
        $eloquentTransaction = $this->query()->find($id);
        return $eloquentTransaction ? $this->hydrate($eloquentTransaction) : null;
    }

    private function query(): Builder
    {
        // this model needs to exist first (and aliased in the import)
        return EloquentTransaction::query();
    }

    private function for(Transaction $transaction): Builder
    {
        return $this->query()->where('id', $transaction->id);
    }

    private function hydrate(Model|EloquentTransaction $eloquentTransaction): Transaction
    {
        return new Transaction(
            id: $eloquentTransaction->id
        );
    }
}
