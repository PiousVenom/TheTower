<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreProfileBannerRequest;
use App\Http\Requests\Api\V1\UpdateProfileBannerRequest;
use App\Http\Resources\Api\V1\ProfileBannerCollection;
use App\Http\Resources\Api\V1\ProfileBannerResource;
use App\Models\ProfileBanner;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="ProfileBanners",
 *     description="Manage available profileBanners"
 * )
 */
class ProfileBannerController extends Controller
{
    /**
     * Soft-delete a profileBanner.
     *
     * @OA\Delete(
     *     path="/profileBanners/{id}",
     *     summary="Delete profileBanner",
     *     tags={"ProfileBanners"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy(ProfileBanner $profileBanner): Response
    {
        $profileBanner->delete();

        return response()->noContent();
    }

    /**
     * List profileBanners (paginated).
     *
     * @OA\Get(
     *     path="/profileBanners",
     *     summary="List profileBanners",
     *     tags={"ProfileBanners"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of profileBanners",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ProfileBannerCollection")
     *     )
     * )
     */
    public function index(): ProfileBannerCollection
    {
        return new ProfileBannerCollection(ProfileBanner::paginate(50));
    }

    /**
     * Restore a soft-deleted profileBanner.
     *
     * @OA\Patch(
     *     path="/profileBanners/{id}/restore",
     *     summary="Restore profileBanner",
     *     tags={"ProfileBanners"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Restored profileBanner",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ProfileBannerResource")
     *     ),
     *
     *     @OA\Response(response=409, description="ProfileBanner is not deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function restore(int|string $id): JsonResponse
    {
        $profileBanner = ProfileBanner::withTrashed()->findOrFail($id);

        if (!$profileBanner->trashed()) {
            return response()->json(
                ['message' => 'ProfileBanner is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $profileBanner->restore();

        return response()->json(
            new ProfileBannerResource($profileBanner)
        );
    }

    /**
     * Retrieve a single profileBanner.
     *
     * @OA\Get(
     *     path="/profileBanners/{id}",
     *     summary="Get a profileBanner",
     *     tags={"ProfileBanners"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="ProfileBanner detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ProfileBannerResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(ProfileBanner $profileBanner): ProfileBannerResource
    {
        return new ProfileBannerResource($profileBanner);
    }

    /**
     * Create a new profileBanner.
     *
     * @OA\Post(
     *     path="/profileBanners",
     *     summary="Create profileBanner",
     *     tags={"ProfileBanners"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreProfileBannerRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ProfileBannerResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreProfileBannerRequest $request): JsonResponse
    {
        $profileBanner = ProfileBanner::create($request->validated());

        return response()->json(
            new ProfileBannerResource($profileBanner),
            Response::HTTP_CREATED
        );
    }

    /**
     * Update an existing profileBanner.
     *
     * @OA\Patch(
     *     path="/profileBanners/{id}",
     *     summary="Update profileBanner",
     *     tags={"ProfileBanners"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateProfileBannerRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Updated profileBanner",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ProfileBannerResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(UpdateProfileBannerRequest $request, ProfileBanner $profileBanner): JsonResponse
    {
        $profileBanner->update($request->validated());

        return response()->json(
            new ProfileBannerResource($profileBanner->refresh())
        );
    }
}
