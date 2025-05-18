<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBonusTypeRequest;
use App\Http\Requests\Api\V1\UpdateBonusTypeRequest;
use App\Http\Resources\Api\V1\BonusTypeCollection;
use App\Http\Resources\Api\V1\BonusTypeResource;
use App\Models\BonusType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 *  Bonus-Type endpoints  (API v1).
 *
 * @OA\Tag(
 *     name="Bonus Types",
 *     description="CRUD & restore operations for bonus-type definitions"
 * )
 */
class BonusTypeController extends Controller
{
    /**
     * Soft-delete a bonus type.
     *
     * @OA\Delete(
     *     path="/bonus-types/{bonus_type}",
     *     summary="Delete (soft) a bonus type",
     *     tags={"Bonus Types"},
     *
     *     @OA\Parameter(
     *         name="bonus_type", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=9)
     *     ),
     *
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy(BonusType $bonusType): Response
    {
        $bonusType->delete();

        return response()->noContent();
    }

    /**
     * List bonus types (paginated).
     *
     * @OA\Get(
     *     path="/bonus-types",
     *     summary="List bonus types",
     *     tags={"Bonus Types"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BonusTypeCollection")
     *     )
     * )
     */
    public function index(): BonusTypeCollection
    {
        return new BonusTypeCollection(
            BonusType::with('category')->paginate(50)
        );
    }

    /**
     * Restore a soft-deleted bonus type.
     *
     * @OA\Patch(
     *     path="/bonus-types/{id}/restore",
     *     summary="Restore a bonus type",
     *     tags={"Bonus Types"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=9)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Restored bonus type",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BonusTypeResource")
     *     ),
     *
     *     @OA\Response(response=409, description="Bonus type is not deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function restore(int|string $id): JsonResponse
    {
        /** @var BonusType $bonusType */
        $bonusType = BonusType::withTrashed()->findOrFail($id);

        if (!$bonusType->trashed()) {
            return response()->json(
                ['message' => 'Bonus type is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $bonusType->restore();

        return response()->json(
            new BonusTypeResource($bonusType->load('category'))
        );
    }

    /**
     * Show a single bonus type.
     *
     * @OA\Get(
     *     path="/bonus-types/{bonus_type}",
     *     summary="Get a bonus type",
     *     tags={"Bonus Types"},
     *
     *     @OA\Parameter(
     *         name="bonus_type", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=9)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Bonus-type detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BonusTypeResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(BonusType $bonusType): BonusTypeResource
    {
        return new BonusTypeResource(
            $bonusType->load('category')
        );
    }

    /**
     * Create a bonus type.
     *
     * @OA\Post(
     *     path="/bonus-types",
     *     summary="Create a bonus type",
     *     tags={"Bonus Types"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreBonusTypeRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BonusTypeResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreBonusTypeRequest $request): JsonResponse
    {
        $validated  = $request->validated();
        $bonusType  = BonusType::create($validated);

        return response()->json(
            new BonusTypeResource($bonusType->load('category')),
            Response::HTTP_CREATED
        );
    }

    /**
     * Update a bonus type.
     *
     * @OA\Patch(
     *     path="/bonus-types/{bonus_type}",
     *     summary="Update a bonus type",
     *     tags={"Bonus Types"},
     *
     *     @OA\Parameter(
     *         name="bonus_type", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=9)
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateBonusTypeRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Updated bonus type",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BonusTypeResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(UpdateBonusTypeRequest $request, BonusType $bonusType): JsonResponse
    {
        $bonusType->update($request->validated());

        return response()->json(
            new BonusTypeResource($bonusType->refresh()->load('category'))
        );
    }
}
