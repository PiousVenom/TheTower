<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\BonusType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin BonusType
 * @property \App\Models\RelicBonus $pivot
 */
class BonusTypeResource extends JsonResource
{
    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'name'  => $this->name,
            'unit'  => $this->unit,
            'value' => $this->pivot->value,   // value lives on the pivot
        ];
    }
}
