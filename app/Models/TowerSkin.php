<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TowerSkinFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class TowerSkin.
 *
 * @property int         $id
 * @property string      $name
 * @property float       $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static TowerSkinFactory          factory($count = null, $state = [])
 * @method static Builder<static>|TowerSkin newModelQuery()
 * @method static Builder<static>|TowerSkin newQuery()
 * @method static Builder<static>|TowerSkin onlyTrashed()
 * @method static Builder<static>|TowerSkin query()
 * @method static Builder<static>|TowerSkin withTrashed()
 * @method static Builder<static>|TowerSkin withoutTrashed()
 * @method static bool                      restore()
 * @method        bool                      restore()
 *
 * @mixin Eloquent
 */
class TowerSkin extends Model
{
    /** @use HasFactory<TowerSkinFactory> */
    use HasFactory;
    use SoftDeletes;

    // Append the camelCase virtual attribute
    protected $appends = ['eventName'];

    protected $fillable = [
        'name',
        'value',
        'event_name',
    ];

    // Hide the raw snake_case column when serializing the model
    protected $hidden = ['event_name'];

    /**
     * Accessor for the camelCase JSON key.
     */
    public function getEventNameAttribute(): string
    {
        /** @var string $eventName */
        $eventName = $this->attributes['event_name'];

        return $eventName;
    }
}
