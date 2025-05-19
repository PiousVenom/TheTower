<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="TierResource",
 *     description="Lookup record for a tier",
 *
 *     @OA\Property(property="id",   type="integer", example=2),
 *     @OA\Property(property="name", type="string",  example="Rare")
 * )
 *
 * @mixin Tier
 */
class TierResource extends JsonResource
{
    /** Remove the default “data” envelope for single resources */
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
