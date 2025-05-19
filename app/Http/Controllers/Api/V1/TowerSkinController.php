<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTowerSkinRequest;
use App\Http\Requests\Api\V1\UpdateTowerSkinRequest;
use App\Http\Resources\Api\V1\TowerSkinCollection;
use App\Http\Resources\Api\V1\TowerSkinResource;
use App\Models\TowerSkin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Tower Skins"
 * )
 */
class TowerSkinController extends Controller
{
    public function destroy(TowerSkin $tower_skin): Response
    {
        $tower_skin->delete();

        return response()->noContent();
    }

    /**
     * List tower skins (paginated).
     *
     * @OA\Get(
     *     path="/tower-skins",
     *     summary="List tower skins",
     *     tags={"Tower Skins"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of tower skins",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TowerSkinCollection")
     *     )
     * )
     */
    public function index(): TowerSkinCollection
    {
        return new TowerSkinCollection(
            TowerSkin::paginate(50)
        );
    }

    public function restore(int|string $id): JsonResponse
    {
        $skin = TowerSkin::withTrashed()->findOrFail($id);

        if (!$skin->trashed()) {
            return response()->json(
                ['message' => 'Tower skin is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $skin->restore();

        return response()->json(
            new TowerSkinResource($skin)
        );
    }

    /**
     * Retrieve a single tower skin.
     *
     * @OA\Get(
     *     path="/tower-skins/{id}",
     *     summary="Get a tower skin",
     *     tags={"Tower Skins"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Tower skin detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TowerSkinResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(TowerSkin $tower_skin): TowerSkinResource
    {
        return new TowerSkinResource($tower_skin);
    }

    public function store(StoreTowerSkinRequest $request): JsonResponse
    {
        $skin = TowerSkin::create($request->validated());

        return response()->json(
            new TowerSkinResource($skin),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateTowerSkinRequest $request, TowerSkin $tower_skin): JsonResponse
    {
        $tower_skin->update($request->validated());

        return response()->json(
            new TowerSkinResource($tower_skin->refresh())
        );
    }
}
