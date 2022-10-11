<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application\Services;

use Enrise\LaravelSonar\Domain\Entities\Transaction;
use Enrise\LaravelSonar\Domain\Entities\TransactionFailure;
use Enrise\LaravelSonar\Domain\Repositories\CurrentTransactionStackInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionRepositoryInterface;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionDateTime;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionId;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionType;

final class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        private readonly TransactionRepositoryInterface $transactionRepository,
        private readonly TransactionFailureRepositoryInterface $transactionFailureRepository,
        private readonly CurrentTransactionStackInterface $currentTransactionStack,
    ) {
    }

    public function start(TransactionType $type, string $class, array $context): Transaction
    {
        $transaction = new Transaction(
            id: TransactionId::new(),
            type: $type,
            class: $class,
            started: TransactionDateTime::now(),
            finished: TransactionDateTime::empty(),
            context: $context,
        );

        $this->currentTransactionStack->push($transaction->id);

        $this->transactionRepository->store($transaction);

        return $transaction;
    }

    public function succeed(Transaction $transaction): void
    {
        $finishedTransaction = $transaction->finish(TransactionDateTime::now());

        $this->transactionRepository->store($finishedTransaction);
    }

    public function fail(Transaction $transaction, string $message): void
    {
        $transactionFailure = new TransactionFailure(
            id: TransactionId::new(),
            transactionId: $transaction->id,
            message: $message,
            isResolved: false,
        );

        $transaction = $transaction->fail()->finish(TransactionDateTime::now());

        $this->transactionRepository->store($transaction);

        $this->transactionFailureRepository->store($transactionFailure);
    }

    public function current(): Transaction
    {
        $transactionId = $this->currentTransactionStack->pop();

        return $this->transactionRepository->find($transactionId);
    }
}
