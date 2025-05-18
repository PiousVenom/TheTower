<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BackgroundSkinFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class BackgroundSkin.
 *
 * @property int         $id
 * @property string      $name
 * @property float       $value
 * @property string      $eventName
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static BackgroundSkinFactory          factory($count = null, $state = [])
 * @method static Builder<static>|BackgroundSkin newModelQuery()
 * @method static Builder<static>|BackgroundSkin newQuery()
 * @method static Builder<static>|BackgroundSkin onlyTrashed()
 * @method static Builder<static>|BackgroundSkin query()
 * @method static Builder<static>|BackgroundSkin whereCreatedAt($value)
 * @method static Builder<static>|BackgroundSkin whereDeletedAt($value)
 * @method static Builder<static>|BackgroundSkin whereId($value)
 * @method static Builder<static>|BackgroundSkin whereName($value)
 * @method static Builder<static>|BackgroundSkin whereUpdatedAt($value)
 * @method static Builder<static>|BackgroundSkin withTrashed()
 * @method static Builder<static>|BackgroundSkin withoutTrashed()
 * @method static bool                           restore()
 * @method        bool                           restore()
 *
 * @mixin Eloquent
 */
class BackgroundSkin extends Model
{
    /** @use HasFactory<BackgroundSkinFactory> */
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
