<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Application;

use Enrise\LaravelSonar\Domain\CurrentTransactionStackInterface;
use Enrise\LaravelSonar\Domain\TransactionId;
use RuntimeException;

final class CurrentTransactionStack implements CurrentTransactionStackInterface
{
    private array $stack = [];

    public function pop(): TransactionId
    {
        $value = array_pop($this->stack);

        if ($value === null) {
            throw new RuntimeException('No current active transactions.');
        }

        return $value;
    }

    public function push(TransactionId $id): void
    {
        $this->stack[] = $id;
    }
}
