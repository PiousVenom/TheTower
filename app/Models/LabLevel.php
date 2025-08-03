<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LabLevelFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class LabLevel.
 *
 * Holds cost and duration for a single lab level.
 *
 * Composite primary key: (<lab_id>, <level>)
 *
 * @property int         $id
 * @property int         $lab_id
 * @property int         $level
 * @property int         $duration_seconds
 * @property float       $cost
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property Lab         $lab
 *
 * @method static LabLevelFactory          factory($count = null, $state = [])
 * @method static Builder<static>|LabLevel newModelQuery()
 * @method static Builder<static>|LabLevel newQuery()
 * @method static Builder<static>|LabLevel onlyTrashed()
 * @method static Builder<static>|LabLevel withTrashed()
 * @method static Builder<static>|LabLevel withoutTrashed()
 * @method static Builder<static>|LabLevel query()
 * @method static bool                     restore()
 * @method        bool                     restore()
 *
 * @mixin Eloquent
 */
class LabLevel extends Model
{
    /** @use HasFactory<LabLevelFactory> */
    use HasFactory;
    use SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'lab_id',
        'level',
        'duration_seconds',
        'cost',
    ];

    /** @return BelongsTo<Lab, $this> */
    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }
}
