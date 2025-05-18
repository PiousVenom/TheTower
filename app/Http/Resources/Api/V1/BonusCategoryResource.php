<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\BonusCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BonusCategoryResource",
 *     description="Grouping bucket for bonus types (Damage, Defense, Utility, Misc).",
 *
 *     @OA\Property(property="id",   type="integer", example=1),
 *     @OA\Property(property="name", type="string",  example="Defense")
 * )
 *
 * @mixin BonusCategory
 */
class BonusCategoryResource extends JsonResource
{
    /** Remove the “data” wrapper for single resources */
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
