<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Repositories;

use Carbon\CarbonImmutable;
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
                'uuid' => $transaction->id,
            ],
            [
                'type' => $transaction->type,
                'class' => $transaction->class,
                'started' => CarbonImmutable::now(),
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
        return $this->query()->where('uuid', $transaction->id);
    }

    private function hydrate(Model|EloquentTransaction $eloquentTransaction): Transaction
    {
        return new Transaction(
            id: TransactionId::fromString($eloquentTransaction->uuid),
            type: TransactionType::from($eloquentTransaction->type),
            class: $eloquentTransaction->class,
            started: TransactionDateTime::fromCarbon($eloquentTransaction->started),
            finished: TransactionDateTime::fromCarbon($eloquentTransaction->finished),
            context: $eloquentTransaction->context ?? [],
        );
    }
}
