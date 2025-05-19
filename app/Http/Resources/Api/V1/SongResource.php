<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="SongResource",
 *     description="Represents a song available in the API",
 *
 *     @OA\Property(property="id",    type="integer", example=1),
 *     @OA\Property(property="name",  type="string",  example="Epic Battle Theme"),
 *     @OA\Property(property="value", type="number",  format="float", example=0.006)
 * )
 *
 * @mixin Song
 */
class SongResource extends JsonResource
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
