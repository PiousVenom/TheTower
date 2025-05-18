<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\MenuFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Menu.
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
 * @method static MenuFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Menu newModelQuery()
 * @method static Builder<static>|Menu newQuery()
 * @method static Builder<static>|Menu onlyTrashed()
 * @method static Builder<static>|Menu withTrashed()
 * @method static Builder<static>|Menu withoutTrashed()
 * @method static Builder<static>|Menu query()
 * @method static bool                 restore()
 * @method        bool                 restore()
 *
 * @mixin Eloquent
 */
class Menu extends Model
{
    /** @use HasFactory<MenuFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
    ];
}
