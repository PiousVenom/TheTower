<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="MenuResource",
 *     description="Represents a Menu available in the API",
 *
 *     @OA\Property(property="id",    type="integer", example=1),
 *     @OA\Property(property="name",  type="string",  example="Dark Being"),
 *     @OA\Property(property="value", type="number",  format="float", example=0.006)
 * )
 *
 * @mixin Menu
 */
class MenuResource extends JsonResource
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
