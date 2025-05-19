<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Relic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="RelicResource",
 *     description="Single relic payload",
 *
 *     @OA\Property(property="id",   type="integer", example=1),
 *     @OA\Property(property="name", type="string",  example="No Spoon"),
 *     @OA\Property(property="tier", type="string",  example="Rare"),
 *     @OA\Property(
 *         property="unlockCondition",
 *         type="string",
 *         nullable=true,
 *         example="Earn 350 medals Matrix event"
 *     ),
 *     @OA\Property(
 *         property="bonuses",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/RelicBonusResource")
 *     )
 * )
 *
 * Relic single-item resource (no "data" wrapper).
 *
 * @mixin Relic
 */
class RelicResource extends JsonResource
{
    /**
     * Disable the default "data" key for single resources.
     */
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'tier'            => $this->tier->name,
            'unlockCondition' => $this->unlock_condition,
            'bonuses'         => RelicBonusResource::collection($this->bonuses->load('category')),
        ];
    }
}
