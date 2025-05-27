<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Schema(
 *     schema="LabCollection",
 *     description="Paginated list of Laboratories",
 *
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/LabResource")
 *     ),
 *
 *     @OA\Property(
 *         property="links",
 *         type="object",
 *         @OA\Property(property="first", type="string", format="uri", example="/api/v1/labs?page=1"),
 *         @OA\Property(property="last",  type="string", format="uri", example="/api/v1/labs?page=4"),
 *         @OA\Property(property="prev",  type="string", format="uri", nullable=true, example=null),
 *         @OA\Property(property="next",  type="string", format="uri", nullable=true, example="/api/v1/labs?page=2")
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="current_page", type="integer", example=1),
 *         @OA\Property(property="from",         type="integer", example=1),
 *         @OA\Property(property="last_page",    type="integer", example=4),
 *         @OA\Property(property="path",         type="string",  format="uri", example="/api/v1/labs"),
 *         @OA\Property(property="per_page",     type="integer", example=15),
 *         @OA\Property(property="to",           type="integer", example=15),
 *         @OA\Property(property="total",        type="integer", example=60)
 *     )
 * )
 */
class LabCollection extends ResourceCollection
{
    public $collects = LabResource::class;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        /** @var array<string,mixed> $array */
        $array = parent::toArray($request);

        return $array;
    }
}
