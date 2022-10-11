<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\EventListeners;

use Enrise\LaravelSonar\Application\TransactionServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Artisan;

final class CommandEventSubscriber
{
    public function __construct(
        private readonly TransactionServiceInterface $transactionService,
    ) {
    }

    public function handleCommandStarting(CommandStarting $commandEvent): void
    {
        $this->transactionService->start();
    }

    public function handleCommandFinished(CommandFinished $commandEvent): void
    {
        $currentTransaction = $this->transactionService->current();
        if ($commandEvent->exitCode !== Command::SUCCESS) {
            $this->transactionService->fail(
                $currentTransaction,
                sprintf('exited with code %d\n%s', $commandEvent->exitCode, Artisan::output())
            );

            return;
        }

        $this->transactionService->succeed($currentTransaction);
    }

    public function subscribe()
    {
        return [
            CommandStarting::class => 'handleCommandStarting',
            CommandFinished::class => 'handleCommandFinished',
        ];
    }
}
