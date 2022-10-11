<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

use DateTimeImmutable;

final class TransactionDateTime
{
    private const FORMAT = 'Y-m-d H:i:s';

    private DateTimeImmutable $dateTime;

    public function __construct(?string $timestamp = null)
    {
        $this->dateTime = new DateTimeImmutable($timestamp ?? 'now');
    }

    public function __toString(): string
    {
        return $this->dateTime->format(self::FORMAT);
    }
}
