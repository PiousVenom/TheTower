<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SongFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Song.
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
 * @method static SongFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Song newModelQuery()
 * @method static Builder<static>|Song newQuery()
 * @method static Builder<static>|Song onlyTrashed()
 * @method static Builder<static>|Song withTrashed()
 * @method static Builder<static>|Song withoutTrashed()
 * @method static Builder<static>|Song query()
 * @method static bool                 restore()
 * @method        bool                 restore()
 *
 * @mixin Eloquent
 */
class Song extends Model
{
    /** @use HasFactory<SongFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
    ];
}
