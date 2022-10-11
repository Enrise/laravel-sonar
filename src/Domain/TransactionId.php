<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class TransactionId
{
    private function __construct(
        private string $uuid
    ) {
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public static function fromString(string $uuid): self
    {
        return new self($uuid);
    }

    public static function new(): self
    {
        return new self('new');
    }
}
