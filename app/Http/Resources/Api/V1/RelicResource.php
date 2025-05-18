<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Relic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Relic single‑item resource (no "data" wrapper).
 *
 * @mixin Relic
 */
class RelicResource extends JsonResource
{
    /**
     * Disable the default "data" key for single resources.
     */
    public static $wrap = null;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'tier'            => $this->tier->name,
            'unlockCondition' => $this->unlock_condition,
            'bonuses'         => BonusTypeResource::collection($this->bonuses),
        ];
    }
}
