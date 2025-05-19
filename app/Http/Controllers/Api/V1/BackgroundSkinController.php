<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBackgroundSkinRequest;
use App\Http\Requests\Api\V1\UpdateBackgroundSkinRequest;
use App\Http\Resources\Api\V1\BackgroundSkinCollection;
use App\Http\Resources\Api\V1\BackgroundSkinResource;
use App\Models\BackgroundSkin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Background Skins"
 * )
 */
class BackgroundSkinController extends Controller
{
    public function destroy(BackgroundSkin $background_skin): Response
    {
        $background_skin->delete();

        return response()->noContent();
    }

    /**
     * List background skins (paginated).
     *
     * @OA\Get(
     *     path="/background-skins",
     *     summary="List background skins",
     *     tags={"Background Skins"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BackgroundSkinCollection")
     *     )
     * )
     */
    public function index(): BackgroundSkinCollection
    {
        return new BackgroundSkinCollection(
            BackgroundSkin::paginate(50)
        );
    }

    public function restore(int|string $id): JsonResponse
    {
        $skin = BackgroundSkin::withTrashed()->findOrFail($id);

        if (!$skin->trashed()) {
            return response()->json(
                ['message' => 'Background skin is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $skin->restore();

        return response()->json(new BackgroundSkinResource($skin));
    }

    /**
     * Retrieve a single background skin.
     *
     * @OA\Get(
     *     path="/background-skins/{id}",
     *     summary="Get a background skin",
     *     tags={"Background Skins"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Background skin detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BackgroundSkinResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(BackgroundSkin $background_skin): BackgroundSkinResource
    {
        return new BackgroundSkinResource($background_skin);
    }

    public function store(StoreBackgroundSkinRequest $request): JsonResponse
    {
        $skin = BackgroundSkin::create($request->validated());

        return response()->json(
            new BackgroundSkinResource($skin),
            Response::HTTP_CREATED
        );
    }

    public function update(
        UpdateBackgroundSkinRequest $request,
        BackgroundSkin $background_skin
    ): JsonResponse {
        $background_skin->update($request->validated());

        return response()->json(
            new BackgroundSkinResource($background_skin->refresh())
        );
    }
}
