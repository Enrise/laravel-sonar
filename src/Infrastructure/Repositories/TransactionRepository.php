<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Repositories;

use Enrise\LaravelSonar\Domain\Transaction;
use Enrise\LaravelSonar\Domain\TransactionDateTime;
use Enrise\LaravelSonar\Domain\TransactionId;
use Enrise\LaravelSonar\Domain\TransactionRepositoryInterface;
use Enrise\LaravelSonar\Domain\TransactionType;
use Enrise\LaravelSonar\Infrastructure\Models\Transaction as EloquentTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class TransactionRepository implements TransactionRepositoryInterface
{
    public function find(TransactionId $id): Transaction
    {
        $eloquentTransaction = $this->query()->find((string) $id);

        return $this->hydrate($eloquentTransaction);
    }

    public function store(Transaction $transaction): void
    {
        EloquentTransaction::updateOrCreate(
            [
                'id' => $transaction->id,
            ],
            [

            ]
        );
    }

    public function updateFinishedAt(Transaction $transaction, TransactionDateTime $finished): void
    {
        $this->for($transaction)->update([
            'finished' => $finished,
        ]);
    }

    private function query(): Builder
    {
        return EloquentTransaction::query();
    }

    private function for(Transaction $transaction): Builder
    {
        return $this->query()->where('id', $transaction->id);
    }

    private function hydrate(Model|EloquentTransaction $eloquentTransaction): Transaction
    {
        return new Transaction(
            id: TransactionId::fromString($eloquentTransaction->id),
            type: TransactionType::from($eloquentTransaction->type),
            class: $eloquentTransaction->class,
            started: $eloquentTransaction->started ? new TransactionDateTime($eloquentTransaction->started) : null,
            finished: $eloquentTransaction->finished ? new TransactionDateTime($eloquentTransaction->finished) : null,
            context: $eloquentTransaction->context ?? [],
        );
    }
}
