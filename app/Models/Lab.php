<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LabFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Lab.
 *
 * A laboratory that can be upgraded through multiple levels.
 *
 * @property int                       $id
 * @property int                       $lab_category_id
 * @property string                    $name
 * @property Carbon|null               $created_at
 * @property Carbon|null               $updated_at
 * @property Carbon|null               $deleted_at
 * @property LabCategory               $category
 * @property Collection<int, LabLevel> $levels
 * @property int|null                  $levels_count
 *
 * @method static LabFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Lab newModelQuery()
 * @method static Builder<static>|Lab newQuery()
 * @method static Builder<static>|Lab onlyTrashed()
 * @method static Builder<static>|Lab withTrashed()
 * @method static Builder<static>|Lab withoutTrashed()
 * @method static Builder<static>|Lab query()
 * @method static bool                restore()
 * @method        bool                restore()
 *
 * @mixin Eloquent
 */
class Lab extends Model
{
    /** @use HasFactory<LabFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lab_category_id',
        'name',
        'description',
    ];

    /** @return BelongsTo<LabCategory, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(LabCategory::class, 'lab_category_id');
    }

    /** @return HasMany<LabLevel, $this> */
    public function levels(): HasMany
    {
        return $this->hasMany(LabLevel::class);
    }
}
