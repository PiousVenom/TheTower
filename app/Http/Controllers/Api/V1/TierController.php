<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTierRequest;
use App\Http\Requests\Api\V1\UpdateTierRequest;
use App\Http\Resources\Api\V1\TierCollection;
use App\Http\Resources\Api\V1\TierResource;
use App\Models\Tier;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 *  Tier endpoints  (API v1).
 *
 * @OA\Tag(
 *     name="Tiers",
 *     description="CRUD & restore operations for tier lookup values"
 * )
 */
class TierController extends Controller
{
    /**
     * Soft-delete a tier.
     *
     * @OA\Delete(
     *     path="/tiers/{tier}",
     *     summary="Delete (soft) a tier",
     *     tags={"Tiers"},
     *
     *     @OA\Parameter(
     *         name="tier", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy(Tier $tier): Response
    {
        $tier->delete();

        return response()->noContent();
    }

    /**
     * List tiers (paginated).
     *
     * @OA\Get(
     *     path="/tiers",
     *     summary="List tiers",
     *     tags={"Tiers"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TierCollection")
     *     )
     * )
     */
    public function index(): TierCollection
    {
        return new TierCollection(Tier::paginate(50));
    }

    /**
     * Restore a soft-deleted tier.
     *
     * @OA\Patch(
     *     path="/tiers/{id}/restore",
     *     summary="Restore a tier",
     *     tags={"Tiers"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Restored tier",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TierResource")
     *     ),
     *
     *     @OA\Response(response=409, description="Tier is not deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function restore(int|string $id): JsonResponse
    {
        /** @var Tier $tier */
        $tier = Tier::withTrashed()->findOrFail($id);

        if (!$tier->trashed()) {
            return response()->json(
                ['message' => 'Tier is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $tier->restore();

        return response()->json(new TierResource($tier));
    }

    /**
     * Show a single tier.
     *
     * @OA\Get(
     *     path="/tiers/{tier}",
     *     summary="Get a tier",
     *     tags={"Tiers"},
     *
     *     @OA\Parameter(
     *         name="tier", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Tier detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TierResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Tier $tier): TierResource
    {
        return new TierResource($tier);
    }

    /**
     * Create a tier.
     *
     * @OA\Post(
     *     path="/tiers",
     *     summary="Create a tier",
     *     tags={"Tiers"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreTierRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TierResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreTierRequest $request): JsonResponse
    {
        $tier = Tier::create($request->validated());

        return response()->json(
            new TierResource($tier),
            Response::HTTP_CREATED
        );
    }

    /**
     * Update a tier.
     *
     * @OA\Patch(
     *     path="/tiers/{tier}",
     *     summary="Update a tier",
     *     tags={"Tiers"},
     *
     *     @OA\Parameter(
     *         name="tier", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateTierRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Updated tier",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TierResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(UpdateTierRequest $request, Tier $tier): JsonResponse
    {
        $tier->update($request->validated());

        return response()->json(new TierResource($tier->refresh()));
    }
}
