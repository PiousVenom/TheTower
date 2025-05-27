<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LabResource",
 *     description="Represents a Laboratory with its category and per-level stats",
 *
 *     @OA\Property(property="id",          type="integer", example=1),
 *     @OA\Property(property="name",        type="string",  example="Workshop A"),
 *     @OA\Property(
 *         property="lab_category",
 *         type="object",
 *         @OA\Property(property="id",   type="integer", example=3),
 *         @OA\Property(property="name", type="string",  example="Workshop")
 *     ),
 *     @OA\Property(
 *         property="levels",
 *         type="array",
 *
 *         @OA\Items(
 *             type="object",
 *
 *             @OA\Property(property="level",            type="integer", example=5),
 *             @OA\Property(property="duration_seconds", type="integer", example=3600),
 *             @OA\Property(property="cost",             type="number",  format="float", example=1500.00)
 *         )
 *     )
 * )
 *
 * @mixin Lab
 */
class LabResource extends JsonResource
{
    /** Disable the default “data” wrapper. */
    public static $wrap;

    /** @return array<string,mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,

            'lab_category' => $this->whenLoaded('category', fn (): array => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ]),

            'levels' => $this->whenLoaded('levels', fn () => $this->levels->map(static fn ($lvl): array => [
                'level'            => $lvl->level,
                'duration_seconds' => $lvl->duration_seconds,
                'cost'             => $lvl->cost,
            ])->values()),
        ];
    }
}
