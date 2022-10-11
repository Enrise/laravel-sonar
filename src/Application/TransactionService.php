<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application;

use Enrise\LaravelSonar\Domain\CurrentTransactionStackInterface;
use Enrise\LaravelSonar\Domain\Transaction;
use Enrise\LaravelSonar\Domain\TransactionDateTime;
use Enrise\LaravelSonar\Domain\TransactionFailure;
use Enrise\LaravelSonar\Domain\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Domain\TransactionId;
use Enrise\LaravelSonar\Domain\TransactionRepositoryInterface;
use Enrise\LaravelSonar\Domain\TransactionType;

final class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        private readonly TransactionRepositoryInterface $transactionRepository,
        private readonly TransactionFailureRepositoryInterface $transactionFailureRepository,
        private  readonly CurrentTransactionStackInterface $currentTransactionStack,
    ) {
    }

    public function start(TransactionType $type, string $class, array $context): Transaction
    {
        $transaction = new Transaction(
            id: TransactionId::new(),
            type: $type,
            class: $class,
            started: TransactionDateTime::now(),
            context: $context,
        );

        $this->currentTransactionStack->push($transaction->id);

        $this->transactionRepository->store($transaction);

        return $transaction;
    }

    public function succeed(Transaction $transaction): void
    {
        $this->transactionRepository->updateFinishedAt($transaction, TransactionDateTime::now());
    }

    public function fail(Transaction $transaction, string $message): void
    {
        $transactionFailure = new TransactionFailure(
            id: TransactionId::new(),
            transactionId: $transaction->id,
            message: $message,
            isResolved: false,
        );

        $this->transactionFailureRepository->store($transactionFailure);
    }

    public function current(): Transaction
    {
        $transactionId = $this->currentTransactionStack->pop();

        return $this->transactionRepository->find($transactionId);
    }
}
