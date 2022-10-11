<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class TransactionFailure extends Model
{
    use HasFactory;
    use HasUlids;

    protected $primaryKey = 'uuid';

    protected $fillable = ['uuid', 'transaction_id', 'error_message', 'is_resolved'];
}
