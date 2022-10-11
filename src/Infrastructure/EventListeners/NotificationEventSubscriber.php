<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\EventListeners;

use Enrise\LaravelSonar\Application\Services\TransactionServiceInterface;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionType;
use Illuminate\Notifications\Events\NotificationFailed;
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
        $this->transactionService->start(TransactionType::NOTIFICATION, get_class($notificationEvent->notification), []);
    }

    public function handleNotificationSent(NotificationSent $notificationEvent): void
    {
        $currentTransaction = $this->transactionService->current();

        $this->transactionService->succeed($currentTransaction);
    }

    public function handleNotificationFailed(NotificationFailed $notificationEvent): void
    {
        $currentTransaction = $this->transactionService->current();

        $this->transactionService->fail(
            $currentTransaction,
            "Could not send notification #{$notificationEvent->notification->id}",
        );
    }

    public function subscribe(): array
    {
        return [
            NotificationSending::class => 'handleNotificationSending',
            NotificationSent::class => 'handleNotificationSent',
            NotificationFailed::class => 'handleNotificationFailed',
        ];
    }
}
