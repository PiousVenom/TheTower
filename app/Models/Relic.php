<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\RelicFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Relic.
 *
 * @property int    $id
 * @property int    $tier_id
 * @property string $name
 * @property int    $bonus_type_id
 * @property float  $value
 * @property bool   $unlocked
 * @property string $unlocked_by
 *
 * Relationships:
 * @property Tier      $tier
 * @property BonusType $bonusType
 *
 * @mixin Eloquent
 */
class Relic extends Model
{
    /** @use HasFactory<RelicFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tier_id',
        'name',
        'bonus_type_id',
        'value',
        'unlocked',
        'unlocked_by',
    ];

    /**
     * One-to-one: the BonusType this Relic belongs to.
     *
     * @return HasOne<BonusType, $this>
     */
    public function bonusType(): HasOne
    {
        return $this->hasOne(BonusType::class);
    }

    /**
     * One-to-one: the Tier this Relic belongs to.
     *
     * @return HasOne<Tier, $this>
     */
    public function tier(): HasOne
    {
        return $this->hasOne(Tier::class);
    }
}
