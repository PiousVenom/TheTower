<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RelicCollection extends ResourceCollection
{
    public $collects = RelicResource::class;

    /**
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var array<string,mixed> $array */
        $array = parent::toArray($request);

        return $array; // cast narrows the return type for Larastan
    }
}
