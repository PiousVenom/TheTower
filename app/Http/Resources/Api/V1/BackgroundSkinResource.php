<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\BackgroundSkin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BackgroundSkinResource",
 *     description="A background skin available in the API",
 *
 *     @OA\Property(property="id",    type="integer", example=1),
 *     @OA\Property(property="name",  type="string",  example="Sunset"),
 *     @OA\Property(property="value", type="number",  format="float", example=0.5000)
 * )
 *
 * @mixin BackgroundSkin
 */
class BackgroundSkinResource extends JsonResource
{
    /** Disable the default "data" wrapper */
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'value' => $this->value,
        ];
    }
}
