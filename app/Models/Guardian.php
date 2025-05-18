<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\GuardianFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Guardian.
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
 * @method static GuardianFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Guardian newModelQuery()
 * @method static Builder<static>|Guardian newQuery()
 * @method static Builder<static>|Guardian onlyTrashed()
 * @method static Builder<static>|Guardian withTrashed()
 * @method static Builder<static>|Guardian withoutTrashed()
 * @method static Builder<static>|Guardian query()
 * @method static bool                     restore()
 * @method        bool                     restore()
 *
 * @mixin Eloquent
 */
class Guardian extends Model
{
    /** @use HasFactory<GuardianFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
    ];
}
