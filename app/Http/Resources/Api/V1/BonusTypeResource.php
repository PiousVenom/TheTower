<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\BonusType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BonusTypeResource",
 *     description="Master definition of a bonus type",
 *
 *     @OA\Property(property="id",   type="integer", example=1),
 *     @OA\Property(property="name", type="string",  example="Defense Absolute"),
 *     @OA\Property(
 *         property="unit",
 *         type="string",
 *         enum={"percentage", "flat", "seconds"},
 *         example="percentage"
 *     ),
 *     @OA\Property(
 *         property="category",
 *         ref="#/components/schemas/BonusCategoryResource"
 *     )
 * )
 *
 * @mixin BonusType
 */
class BonusTypeResource extends JsonResource
{
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'unit'     => $this->unit,
            'category' => new BonusCategoryResource($this->whenLoaded('category')),
        ];
    }
}
