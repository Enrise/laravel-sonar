<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\ValueObjects;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTimeImmutable;

final class TransactionDateTime
{
    private const FORMAT = 'Y-m-d H:i:s';

    public static function fromCarbon(?Carbon $carbonDateTime): self
    {
        return new self($carbonDateTime !== null ? $carbonDateTime->toDateTimeImmutable() : null);
    }

    public static function now(): self
    {
        return new self(new DateTimeImmutable());
    }

    public static function empty(): self
    {
        return new self(null);
    }

    public function __construct(
        private readonly ?DateTimeImmutable $dateTime
    ) {
    }

    public function __toString(): string
    {
        return $this->dateTime->format(self::FORMAT);
    }

    public function toCarbon(): ?CarbonImmutable
    {
        return $this->dateTime !== null ? new CarbonImmutable($this->dateTime) : null;
    }
}
