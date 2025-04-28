<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TierFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tier.
 *
 * @property int    $id
 * @property string $name
 *
 * Relationships:
 *
 * @mixin Eloquent
 */
class Tier extends Model
{
    /** @use HasFactory<TierFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
}
