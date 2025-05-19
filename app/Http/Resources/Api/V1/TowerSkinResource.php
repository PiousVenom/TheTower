<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\TowerSkin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="TowerSkinResource",
 *     description="A tower skin available in the API",
 *
 *     @OA\Property(property="id",         type="integer", example=1),
 *     @OA\Property(property="name",       type="string",  example="Celestial Tower"),
 *     @OA\Property(property="value",      type="number",  format="float", example=0.7500),
 *     @OA\Property(
 *         property="eventName",
 *         type="string",
 *         nullable=true,
 *         example="Guild Season Finale"
 *     )
 * )
 *
 * @mixin TowerSkin
 */
class TowerSkinResource extends JsonResource
{
    /** Disable the default "data" wrapper */
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'value'     => $this->value,
            'eventName' => $this->eventName,
        ];
    }
}
