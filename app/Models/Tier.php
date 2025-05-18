<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TierFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tier.
 *
 * Lookup model for relic tiers (rarities).
 *
 * @property int    $id
 * @property string $name
 *
 * Relationships:
 * @property Collection<int,Relic> $relics
 *
 * @mixin Eloquent
 *
 * @property int|null $relics_count
 *
 * @method static TierFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Tier newModelQuery()
 * @method static Builder<static>|Tier newQuery()
 * @method static Builder<static>|Tier onlyTrashed()
 * @method static Builder<static>|Tier query()
 * @method static Builder<static>|Tier withTrashed()
 * @method static Builder<static>|Tier withoutTrashed()
 *
 * @mixin Eloquent
 */
class Tier extends Model
{
    /** @use HasFactory<TierFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * Mass‑assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /* ----------------------------------------------------------------- */
    /* Relationships */
    /* ----------------------------------------------------------------- */

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
