<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Schema(
 *     schema="MenuCollection",
 *     description="Paginated list of Menus",
 *
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/MenuResource")
 *     ),
 *
 *     @OA\Property(
 *         property="links",
 *         type="object",
 *         @OA\Property(property="first", type="string", format="uri", example="/api/v1/menus?page=1"),
 *         @OA\Property(property="last",  type="string", format="uri", example="/api/v1/menus?page=2"),
 *         @OA\Property(property="prev",  type="string", format="uri", nullable=true, example=null),
 *         @OA\Property(property="next",  type="string", format="uri", nullable=true, example="/api/v1/menus?page=2")
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="current_page", type="integer", example=1),
 *         @OA\Property(property="from",         type="integer", example=1),
 *         @OA\Property(property="last_page",    type="integer", example=2),
 *         @OA\Property(property="path",         type="string",  format="uri", example="/api/v1/menus"),
 *         @OA\Property(property="per_page",     type="integer", example=50),
 *         @OA\Property(property="to",           type="integer", example=50),
 *         @OA\Property(property="total",        type="integer", example=100)
 *     )
 * )
 */
class MenuCollection extends ResourceCollection
{
    public $collects = MenuResource::class;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        /** @var array<string,mixed> $array */
        $array = parent::toArray($request);

        return $array;
    }
}
