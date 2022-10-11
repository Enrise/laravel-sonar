<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

use DateTimeImmutable;

class TransactionDateTime
{
    private DateTimeImmutable $dateTime;

    public function __construct()
    {
        $this->dateTime = new DateTimeImmutable();
    }

    public function __toString(): string
    {
        return (string)($this->dateTime->getTimestamp());
    }
}
