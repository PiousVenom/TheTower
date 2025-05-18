<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreRelicRequest;
use App\Http\Requests\Api\V1\UpdateRelicRequest;
use App\Http\Resources\Api\V1\RelicCollection;
use App\Http\Resources\Api\V1\RelicResource;
use App\Models\Relic;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as Http;

/**
 *  Relic endpoints  (API v1).
 *
 * @OA\Tag(
 *     name="Relics",
 *     description="CRUD & restore operations for relics"
 * )
 *
 *  Global path prefix comes from routes:
 */
class RelicController extends Controller
{
    /**
     * Delete (soft-delete) a relic.
     *
     * @OA\Delete(
     *     path="/relics/{relic}",
     *     summary="Soft-delete a relic",
     *     tags={"Relics"},
     *
     *     @OA\Parameter(
     *         name="relic",
     *         in="path",
     *         required=true,
     *         description="Relic ID",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=204,
     *         description="Deleted (no content)"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Relic not found"
     *     )
     * )
     */
    public function destroy(Relic $relic): Response
    {
        $relic->delete();

        return response()->noContent();
    }

    /**
     * List relics (paginated).
     *
     * @OA\Get(
     *     path="/relics",
     *     summary="List relics",
     *     tags={"Relics"},
     *
     *     @OA\Parameter(
     *         name="page", in="query", @OA\Schema(type="integer", minimum=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page", in="query",
     *         description="Items per page (default 50)",
     *
     *         @OA\Schema(type="integer", minimum=1, maximum=100)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list",
     *
     *         @OA\JsonContent(ref="#/components/schemas/RelicCollection")
     *     )
     * )
     */
    public function index(): RelicCollection
    {
        return new RelicCollection(
            Relic::with(['tier', 'bonuses'])->paginate(50)
        );
    }

    /**
     * Restore (undelete) a relic.
     *
     * @OA\Patch(
     *     path="/relics/{id}/restore",
     *     summary="Restore a soft-deleted relic",
     *     tags={"Relics"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true, description="Relic ID",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Restored relic",
     *
     *         @OA\JsonContent(ref="#/components/schemas/RelicResource")
     *     ),
     *
     *     @OA\Response(
     *         response=409,
     *         description="Relic is not deleted"
     *     ),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function restore(int|string $id): RelicResource|JsonResponse
    {
        /** @var Relic $relic */
        $relic = Relic::withTrashed()->findOrFail($id);

        if (!$relic->trashed()) {
            return response()->json([
                'message' => 'Relic is not deleted.',
            ], Http::HTTP_CONFLICT);
        }

        $relic->restore();

        return new RelicResource(
            $relic->load(['tier', 'bonuses'])
        );
    }

    /**
     * Show a single relic.
     *
     * @OA\Get(
     *     path="/relics/{relic}",
     *     summary="Get a relic",
     *     tags={"Relics"},
     *
     *     @OA\Parameter(
     *         name="relic", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Relic detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/RelicResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Relic $relic): RelicResource
    {
        return new RelicResource(
            $relic->load(['tier', 'bonuses'])
        );
    }

    /**
     * Create a relic.
     *
     * @OA\Post(
     *     path="/relics",
     *     summary="Create a relic",
     *     tags={"Relics"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreRelicRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(ref="#/components/schemas/RelicResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreRelicRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Create Relic
        $relic = Relic::create([
            'name'             => $validated['name'],
            'tier_id'          => $validated['tier_id'],
            'unlock_condition' => $validated['unlock_condition'] ?? null,
        ]);

        // Attach bonus value via pivot
        $relic->bonuses()->attach([
            $validated['bonus_type_id'] => ['value' => $validated['value']],
        ]);

        return response()->json($relic->load(['tier', 'bonuses']), Response::HTTP_CREATED);
    }

    /**
     * Update a relic.
     *
     * @OA\Patch(
     *     path="/relics/{relic}",
     *     summary="Update a relic",
     *     tags={"Relics"},
     *
     *     @OA\Parameter(
     *         name="relic", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateRelicRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Updated relic",
     *
     *         @OA\JsonContent(ref="#/components/schemas/RelicResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(UpdateRelicRequest $request, Relic $relic): JsonResponse
    {
        $validated = $request->validated();

        // Update relic core fields
        $relic->update(array_filter([
            'name'             => $validated['name'] ?? null,
            'tier_id'          => $validated['tier_id'] ?? null,
            'unlock_condition' => $validated['unlock_condition'] ?? null,
        ], static fn ($v) => $v !== null));

        // Update bonus pivot if provided
        if ($request->filled('bonus_type_id') || $request->filled('value')) {
            // Detach old
            $relic->bonuses()->detach();

            // Get the bonus type ID and value
            $bonusTypeId = $validated['bonus_type_id'] ?? $relic->bonuses()->first()?->id;
            $bonusValue  = $validated['value'] ?? $relic->bonuses()->first()?->pivot?->value;

            if ($bonusTypeId !== null && $bonusValue !== null) {
                // Attach new / same type with possibly new value
                $relic->bonuses()->attach([
                    $bonusTypeId => ['value' => $bonusValue],
                ]);
            }
        }

        return response()->json($relic->refresh()->load(['tier', 'bonuses']));
    }
}
