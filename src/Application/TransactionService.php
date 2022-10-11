<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application;

use Enrise\LaravelSonar\Domain\Transaction;
use Enrise\LaravelSonar\Domain\TransactionFailure;
use Enrise\LaravelSonar\Domain\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Domain\TransactionRepositoryInterface;

class TransactionService implements TransactionServiceInterface
{
    public function __construct(
        private readonly TransactionRepositoryInterface $transactionRepository,
        private readonly TransactionFailureRepositoryInterface $transactionFailureRepository,
    )
    {
    }

    public function start(): Transaction
    {
        // todo: uui
        $transaction = new Transaction(0);

        $this->transactionRepository->store($transaction);

        return $transaction;
    }

    public function succeed(Transaction $transaction): void
    {
        //todo: save finished
        $this->transactionRepository->store($transaction);
    }

    public function fail(Transaction $transaction, string $message): void
    {
        //todo: uuid
        $transactionFailure = new TransactionFailure(
            id: 0,
            transactionId: $transaction->id,
            message: $message,
            isResolved: false,
        );

        $this->transactionFailureRepository->store($transactionFailure);
    }
}
