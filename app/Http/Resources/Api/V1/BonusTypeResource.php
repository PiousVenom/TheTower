<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\BonusType;
use App\Models\RelicBonus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BonusTypeResource",
 *     description="Bonus attached to a relic",
 *
 *     @OA\Property(property="name",  type="string",  example="Defense Absolute"),
 *     @OA\Property(property="unit",  type="string",  example="percentage"),
 *     @OA\Property(property="value", type="number",  format="float", example=0.02)
 * )
 *
 * @mixin BonusType
 *
 * @property RelicBonus $pivot
 */
class BonusTypeResource extends JsonResource
{
    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'name'  => $this->name,
            'unit'  => $this->unit,
            'value' => $this->pivot->value,   // value lives on the pivot
        ];
    }
}
