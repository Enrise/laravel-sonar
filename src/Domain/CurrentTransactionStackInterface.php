<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Domain;

interface CurrentTransactionStackInterface
{
    public function pop(): TransactionId;

    public function push(TransactionId $id): void;
}
