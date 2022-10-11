<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\Entities;

use Enrise\LaravelSonar\Domain\ValueObjects\TransactionDateTime;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionId;
use Enrise\LaravelSonar\Domain\ValueObjects\TransactionType;

final class Transaction
{
    public function __construct(
        public readonly TransactionId $id,
        public readonly TransactionType $type,
        public readonly string $class,
        public readonly TransactionDateTime $started,
        public readonly array $context = [],
        public readonly ?TransactionDateTime $finished = null,
        public readonly bool $isFailed = false,
    ) {
    }

    public function fail(): self
    {
        return new self(
            $this->id,
            $this->type,
            $this->class,
            $this->started,
            $this->context,
            $this->finished,
            true,
        );
    }

    public function finish(TransactionDateTime $finishDateTime): self
    {
        return new self(
            $this->id,
            $this->type,
            $this->class,
            $this->started,
            $this->context,
            $finishDateTime,
            $this->isFailed,
        );
    }
}
