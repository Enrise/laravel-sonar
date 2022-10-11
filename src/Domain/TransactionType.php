<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

enum TransactionType: string
{
    case NOTIFICATION = 'notification';
    case SCHEDULE = 'schedule';
    case COMMAND = 'command';
}
