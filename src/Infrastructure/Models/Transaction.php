<?php

declare(strict_types=1);

namespace Enrise\LaravelSonar\Infrastructure\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Transaction extends Model
{
    use HasFactory;
    use HasUlids;

    public $timestamps = false;

    protected $primaryKey = 'uuid';

    protected $fillable = ['uuid', 'type', 'class', 'context', 'started', 'finished'];
}
