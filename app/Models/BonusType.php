<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\BonusTypeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class BonusType.
 * 
 * Master list of bonus *kinds* that can be applied to relics.
 *
 * @property int $id
 * @property int|null $bonus_category_id
 * @property string $name
 * @property string $unit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\BonusCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Relic> $relics
 * @property-read int|null $relics_count
 * @method static \Database\Factories\BonusTypeFactory factory($count = null, $state = [])
 * @method static Builder<static>|BonusType newModelQuery()
 * @method static Builder<static>|BonusType newQuery()
 * @method static Builder<static>|BonusType onlyTrashed()
 * @method static Builder<static>|BonusType query()
 * @method static Builder<static>|BonusType whereBonusCategoryId($value)
 * @method static Builder<static>|BonusType whereCreatedAt($value)
 * @method static Builder<static>|BonusType whereDeletedAt($value)
 * @method static Builder<static>|BonusType whereId($value)
 * @method static Builder<static>|BonusType whereName($value)
 * @method static Builder<static>|BonusType whereUnit($value)
 * @method static Builder<static>|BonusType whereUpdatedAt($value)
 * @method static Builder<static>|BonusType withTrashed()
 * @method static Builder<static>|BonusType withoutTrashed()
 * @mixin \Eloquent
 */
class BonusType extends Model
{
    /** @use HasFactory<BonusTypeFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * Mass‑assignable attributes.
     */
    protected $fillable = [
        'name',
        'unit',
    ];

    /* ----------------------------------------------------------------- */
    /* Relationships */
    /* ----------------------------------------------------------------- */

    /**
     * The category this bonus belongs to (e.g. Damage, Defense, Utility, Misc).
     *
     * @return BelongsTo<BonusCategory, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BonusCategory::class, 'bonus_category_id');
    }

    /**
     * Relationship: Relics belonging to this BonusType.
     *
     * @return BelongsToMany<Relic, $this>
     */
    public function relics(): BelongsToMany
    {
        return $this->belongsToMany(
            Relic::class,
            'relic_bonus'
        );
    }
}
