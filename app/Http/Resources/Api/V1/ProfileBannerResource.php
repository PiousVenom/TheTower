<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\ProfileBanner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ProfileBannerResource",
 *     description="Represents a ProfileBanner available in the API",
 *
 *     @OA\Property(property="id",    type="integer", example=1),
 *     @OA\Property(property="name",  type="string",  example="Mech World"),
 *     @OA\Property(property="value", type="number",  format="float", example=0.006)
 * )
 *
 * @mixin ProfileBanner
 */
class ProfileBannerResource extends JsonResource
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
