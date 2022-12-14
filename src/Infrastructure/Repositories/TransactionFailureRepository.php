<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Repositories;

use Enrise\LaravelSonar\Domain\Entities\TransactionFailure;
use Enrise\LaravelSonar\Domain\Repositories\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Infrastructure\Models\TransactionFailure as EloquentTransactionFailure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class TransactionFailureRepository implements TransactionFailureRepositoryInterface
{
    public function all(): array
    {
        return $this->query()->get()->toArray();
    }

    public function find(int $id): TransactionFailure
    {
        $eloquentTransactionFailure = $this->query()->findOrFail($id);

        return $this->hydrate($eloquentTransactionFailure);
    }

    public function store(TransactionFailure $transactionFailure): void
    {
        $this->query()->create([
            'is_resolved' => $transactionFailure->isResolved,
            'error_message' => $transactionFailure->message,
            'transaction_id' => $transactionFailure->transactionId,
        ]);
    }

    private function query(): Builder
    {
        // this model needs to exist first (and aliased in the import)
        return EloquentTransactionFailure::query();
    }

    private function for(TransactionFailure $transaction): Builder
    {
        return $this->query()->where('id', $transaction->id);
    }

    private function hydrate(Model|EloquentTransactionFailure $eloquentTransactionFailure): TransactionFailure
    {
        return new TransactionFailure(
            id: $eloquentTransactionFailure->id,
            transactionId: $eloquentTransactionFailure->transaction_id,
            message: $eloquentTransactionFailure->message,
            isResolved: $eloquentTransactionFailure->is_resolved,
        );
    }
}
