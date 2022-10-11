<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Actions;

use Enrise\LaravelSonar\Domain\Repositories\TransactionFailureRepositoryInterface;
use Enrise\LaravelSonar\Domain\Repositories\TransactionRepositoryInterface;

final class DashboardAction
{
    public function __construct(
        private TransactionRepositoryInterface $transactions,
        private TransactionFailureRepositoryInterface $failures
    ) {
    }

    public function __invoke()
    {
        return view('laravel-sonar::index', [
            'transactions' => $this->transactions->all(),
            'failures' => $this->failures->all(),
        ]);
    }
}
