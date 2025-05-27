<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LabCategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class LabCategory.
 *
 * @property int         $id
 * @property string      $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int|null    $lab_categories_count
 *
 * @method static LabCategoryFactory          factory($count = null, $state = [])
 * @method static Builder<static>|LabCategory newModelQuery()
 * @method static Builder<static>|LabCategory newQuery()
 * @method static Builder<static>|LabCategory onlyTrashed()
 * @method static Builder<static>|LabCategory query()
 * @method static Builder<static>|LabCategory whereCreatedAt($value)
 * @method static Builder<static>|LabCategory whereDeletedAt($value)
 * @method static Builder<static>|LabCategory whereId($value)
 * @method static Builder<static>|LabCategory whereName($value)
 * @method static Builder<static>|LabCategory whereUpdatedAt($value)
 * @method static Builder<static>|LabCategory withTrashed()
 * @method static Builder<static>|LabCategory withoutTrashed()
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
}
