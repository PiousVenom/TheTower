<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\BonusTypeFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BonusType.
 *
 * @property int    $id
 * @property string $name
 *
 * Relationships:
 * @property Collection|Relic[] $relics
 *
 * @mixin Eloquent
 *
 * @property int|null $relics_count
 *
 * @method static \Database\Factories\BonusTypeFactory                    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusType withoutTrashed()
 *
 * @mixin \Eloquent
 */
class BonusType extends Model
{
    /** @use HasFactory<BonusTypeFactory> */
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
