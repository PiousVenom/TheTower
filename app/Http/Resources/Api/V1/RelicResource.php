<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RelicResource extends JsonResource
{
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'tier'            => $this->tier->name,          // just the name
            'unlockCondition' => $this->unlock_condition,    // camel-cased key
            'bonuses'         => BonusTypeResource::collection($this->bonuses),
        ];
    }
}
