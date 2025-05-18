<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\BonusType;
use App\Models\RelicBonus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="RelicBonusResource",
 *     description="Bonus as it appears on a relic (includes rolled value)",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/BonusTypeResource"),
 *         @OA\Schema(
 *
 *             @OA\Property(property="value", type="number", format="float", example=0.02)
 *         )
 *     }
 * )
 *
 * @mixin BonusType
 *
 * @property RelicBonus $pivot
 */
class RelicBonusResource extends JsonResource
{
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'unit'     => $this->unit,
            'value'    => $this->pivot->value,
            'category' => new BonusCategoryResource($this->whenLoaded('category')),
        ];
    }
}
