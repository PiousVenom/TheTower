<?php

declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class BonusCategory.
 *
 * Groups BonusType records into logical categories (e.g. "Offense", "Economy").
 *
 * @property int         $id
 * @property string      $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * Relationships:
 * @property Collection<int,BonusType> $bonusTypes
 *
 * @method static BonusCategoryFactory          factory($count = null, $state = [])
 * @method static Builder<static>|BonusCategory newModelQuery()
 * @method static Builder<static>|BonusCategory newQuery()
 * @method static Builder<static>|BonusCategory onlyTrashed()
 * @method static Builder<static>|BonusCategory query()
 * @method static Builder<static>|BonusCategory withTrashed()
 * @method static Builder<static>|BonusCategory withoutTrashed()
 *
 * @mixin Eloquent
 */
class BonusCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var array<int, string> */
    protected $fillable = [
        'name',
    ];

    /* ----------------------------------------------------------------- */
    /* Relationships */
    /* ----------------------------------------------------------------- */

    /**
     * Relationship: BonusType belonging to this BonusCategory.
     *
     * @return HasMany<BonusType, $this>
     */
    public function bonusTypes(): HasMany
    {
        return $this->hasMany(BonusType::class);
    }
}
