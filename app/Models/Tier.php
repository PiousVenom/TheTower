<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TierFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tier.
 *
 * @property int    $id
 * @property string $name
 *
 * Relationships:
 * @property Collection<int, Relic> $relics
 *
 * @mixin Eloquent
 *
 * @property int|null $relics_count
 *
 * @method static \Database\Factories\TierFactory                    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tier withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Tier extends Model
{
    /** @use HasFactory<TierFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Relationship: Relics belonging to this BonusType.
     *
     * @return HasMany<Relic, $this>
     */
    public function relics(): HasMany
    {
        return $this->hasMany(Relic::class);
    }
}
