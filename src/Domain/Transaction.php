<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

final class Transaction
{
    public function __construct(
        public readonly TransactionId $id,
        public readonly TransactionType $type,
        public readonly string $class,
        public readonly ?TransactionDateTime $started = null,
        public readonly ?TransactionDateTime $finished = null,
        public readonly array $context = [],
    ) {
    }

    public static function new(): self
    {
        return new self(
            TransactionId::new(),
        );
    }
}
