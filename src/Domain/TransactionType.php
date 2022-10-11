<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

enum TransactionType {
    case NOTIFICATION;
    case SCHEDULE;
    case COMMAND;
}
