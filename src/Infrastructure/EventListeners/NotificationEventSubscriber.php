<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\EventListeners;

use Enrise\LaravelSonar\Application\Services\TransactionServiceInterface;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionType;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Events\NotificationSent;

final class NotificationEventSubscriber
{
    public function __construct(
        private readonly TransactionServiceInterface $transactionService,
    ) {
    }

    public function handleNotificationSending(NotificationSending $notificationEvent): void
    {
        $this->transactionService->start(TransactionType::COMMAND, get_class($notificationEvent->notification), []);
    }

    public function handleNotificationSent(NotificationSent $notificationEvent): void
    {
        $currentTransaction = $this->transactionService->current();

        dd($notificationEvent);

        if ($notificationEvent->exitCode !== Command::SUCCESS) {
            $this->transactionService->fail(
                $currentTransaction,
                sprintf('exited with code %d\n%s', $notificationEvent->exitCode, Artisan::output())
            );

            return;
        }

        $this->transactionService->succeed($currentTransaction);
    }

    public function subscribe(): array
    {
        return [
            NotificationSending::class => 'handleNotificationSending',
            NotificationSent::class => 'handleNotificationSent',
        ];
    }
}
