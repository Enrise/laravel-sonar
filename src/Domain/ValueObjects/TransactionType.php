<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\ValueObjects;

enum TransactionType: string
{
    case NOTIFICATION = 'notification';
    case SCHEDULE = 'schedule';
    case COMMAND = 'command';
}
