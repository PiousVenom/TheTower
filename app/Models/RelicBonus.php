<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class RelicBonus
 *
 * Pivot model that links a Relic to exactly one BonusType and stores the
 * **value** of that bonus for the relic.
 *
 *
 * @property int           $id
 * @property int           $relic_id
 * @property int           $bonus_type_id
 * @property string        $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * Relationships:
 * @property-read Relic $relic
 * @property-read BonusType $bonusType
 *
 * @mixin Eloquent
 *
 * @method static RelicBonusFactory          factory($count = null, $state = [])
 * @method static Builder<static>|RelicBonus newModelQuery()
 * @method static Builder<static>|RelicBonus newQuery()
 * @method static Builder<static>|RelicBonus onlyTrashed()
 * @method static Builder<static>|RelicBonus query()
 * @method static Builder<static>|RelicBonus withTrashed()
 * @method static Builder<static>|RelicBonus withoutTrashed()
 */
class RelicBonus extends Pivot
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Table name override because this is a pivot.
     *
     * @var string
     */
    protected $table = 'relic_bonus';

    /**
     * Mass‑assignable columns.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'relic_id',
        'bonus_type_id',
        'value',
    ];

    /**
     * Casts.
     *
     * @var array<string,string>
     */
    protected $casts = [
        // four‑decimal precision to match migration
        'value' => 'decimal:4',
    ];

    /* ----------------------------------------------------------------- */
    /* Relationships                                                     */
    /* ----------------------------------------------------------------- */

    /**
     * The relic that owns this bonus.
     * @return BelongsTo<Relic, $this>
     */
    public function relic(): BelongsTo
    {
        return $this->belongsTo(Relic::class);
    }

    /**
     * The type (kind) of bonus applied.
     *
     * @return BelongsTo<BonusType, $this>
     */
    public function bonusType(): BelongsTo
    {
        return $this->belongsTo(BonusType::class);
    }
}
