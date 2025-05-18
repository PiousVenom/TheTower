<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class RelicBonus.
 * 
 * Pivot model that links a Relic to exactly one BonusType and stores the
 * **value** of that bonus for the relic.
 *
 * @property int $id
 * @property int $relic_id
 * @property int $bonus_type_id
 * @property numeric $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\BonusType $bonusType
 * @property-read \App\Models\Relic $relic
 * @method static Builder<static>|RelicBonus newModelQuery()
 * @method static Builder<static>|RelicBonus newQuery()
 * @method static Builder<static>|RelicBonus onlyTrashed()
 * @method static Builder<static>|RelicBonus query()
 * @method static Builder<static>|RelicBonus whereBonusTypeId($value)
 * @method static Builder<static>|RelicBonus whereCreatedAt($value)
 * @method static Builder<static>|RelicBonus whereDeletedAt($value)
 * @method static Builder<static>|RelicBonus whereId($value)
 * @method static Builder<static>|RelicBonus whereRelicId($value)
 * @method static Builder<static>|RelicBonus whereUpdatedAt($value)
 * @method static Builder<static>|RelicBonus whereValue($value)
 * @method static Builder<static>|RelicBonus withTrashed()
 * @method static Builder<static>|RelicBonus withoutTrashed()
 * @mixin \Eloquent
 */
class RelicBonus extends Pivot
{
    use SoftDeletes;

    /**
     * Casts.
     */
    protected $casts = [
        // four‑decimal precision to match migration
        'value' => 'decimal:4',
    ];

    /**
     * Mass‑assignable columns.
     */
    protected $fillable = [
        'relic_id',
        'bonus_type_id',
        'value',
    ];

    /**
     * Table name override because this is a pivot.
     */
    protected $table = 'relic_bonus';

    /**
     * The type (kind) of bonus applied.
     *
     * @return BelongsTo<BonusType, $this>
     */
    public function bonusType(): BelongsTo
    {
        return $this->belongsTo(BonusType::class);
    }

    /* ----------------------------------------------------------------- */
    /* Relationships */
    /* ----------------------------------------------------------------- */

    /**
     * The relic that owns this bonus.
     *
     * @return BelongsTo<Relic, $this>
     */
    public function relic(): BelongsTo
    {
        return $this->belongsTo(Relic::class);
    }
}
