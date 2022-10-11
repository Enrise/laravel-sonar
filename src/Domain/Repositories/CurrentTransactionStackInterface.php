<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain\Repositories;

use Enrise\LaravelSonar\Domain\ValueObjects\TransactionId;

interface CurrentTransactionStackInterface
{
    public function pop(): TransactionId;

    public function push(TransactionId $id): void;
}
