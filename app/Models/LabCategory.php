<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LabCategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class LabCategory.
 *
 * Groups related laboratories (e.g. “Game”, “Workshop”).
 *
 * @property int                  $id
 * @property string               $name
 * @property Carbon|null          $created_at
 * @property Carbon|null          $updated_at
 * @property Carbon|null          $deleted_at
 * @property Collection<int, Lab> $labs
 * @property int|null             $labs_count
 *
 * @method static LabCategoryFactory          factory($count = null, $state = [])
 * @method static Builder<static>|LabCategory newModelQuery()
 * @method static Builder<static>|LabCategory newQuery()
 * @method static Builder<static>|LabCategory onlyTrashed()
 * @method static Builder<static>|LabCategory withTrashed()
 * @method static Builder<static>|LabCategory withoutTrashed()
 * @method static Builder<static>|LabCategory query()
 * @method static bool                        restore()
 * @method        bool                        restore()
 *
 * @mixin Eloquent
 */
class LabCategory extends Model
{
    /** @use HasFactory<LabCategoryFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /** @return HasMany<Lab, $this> */
    public function labs(): HasMany
    {
        return $this->hasMany(Lab::class);
    }
}
