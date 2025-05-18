<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RelicCollection extends ResourceCollection
{
    public $collects = RelicResource::class;   // each item uses RelicResource

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        // Parent puts items in "data"; we can pass that straight through
        return parent::toArray($request);
    }
}
