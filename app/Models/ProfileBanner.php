<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProfileBannerFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class ProfileBanner.
 *
 * Represents a background music track available for selection.
 *
 * @property int         $id
 * @property string      $name
 * @property float       $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static ProfileBannerFactory          factory($count = null, $state = [])
 * @method static Builder<static>|ProfileBanner newModelQuery()
 * @method static Builder<static>|ProfileBanner newQuery()
 * @method static Builder<static>|ProfileBanner onlyTrashed()
 * @method static Builder<static>|ProfileBanner withTrashed()
 * @method static Builder<static>|ProfileBanner withoutTrashed()
 * @method static Builder<static>|ProfileBanner query()
 * @method static bool                          restore()
 * @method        bool                          restore()
 *
 * @mixin Eloquent
 */
class ProfileBanner extends Model
{
    /** @use HasFactory<ProfileBannerFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
    ];
}
