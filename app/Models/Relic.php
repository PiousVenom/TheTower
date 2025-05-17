<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\RelicFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Relic
 *
 * Represents a unique relic that players can own or discover.
 * A relic belongs to a single Tier and (currently) carries exactly one bonus
 * defined via the relic_bonus pivot table. The pivot table enforces
 * a UNIQUE(relic_id) constraint so that only one bonus exists today, while
 * still allowing the schema to evolve to many‑to‑many later with a single
 * migration that drops that unique key.
 *
 * @property int $id
 * @property string $name
 * @property int $tier_id
 * @property string|null $unlock_condition
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * Relationships:
 * @property-read Tier $tier
 * @property-read Collection<int,BonusType> $bonuses
 * @property-read BonusType|null $bonus (dynamic accessor)
 *
 * @mixin Eloquent
 *
 * @method static RelicFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Relic newModelQuery()
 * @method static Builder<static>|Relic newQuery()
 * @method static Builder<static>|Relic onlyTrashed()
 * @method static Builder<static>|Relic query()
 * @method static Builder<static>|Relic withTrashed()
 * @method static Builder<static>|Relic withoutTrashed()
 *
 * @mixin Eloquent
 */
class Relic extends Model
{
    /** @use HasFactory<RelicFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * Mass‑assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tier_id',
        'unlock_condition',
    ];

    /* ----------------------------------------------------------------- */
    /* Relationships                                                     */
    /* ----------------------------------------------------------------- */

    /**
     * Tier to which this relic belongs.
     *
     * @return BelongsTo<Tier, $this>
     */
    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class);
    }

    /**
     * Bonus types linked via relic_bonus pivot.
     *
     * @return BelongsToMany<BonusType, $this>
     */
    public function bonuses(): BelongsToMany
    {
        return $this->belongsToMany(
            BonusType::class,
            'relic_bonus'
        )->withPivot(['value'])
            ->using(RelicBonus::class);
    }

    /**
     * Convenience accessor for the *single* bonus a relic has today.
     * @return BonusType|null
     */
    public function bonus(): ?BonusType
    {
        return $this->bonuses()->first();
    }
}
