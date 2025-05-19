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
 *     name="Profile Banners"
 * )
 */
class ProfileBannerController extends Controller
{
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
     *     summary="List profile banners",
     *     tags={"Profile Banners"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of profile banners",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ProfileBannerCollection")
     *     )
     * )
     */
    public function index(): ProfileBannerCollection
    {
        return new ProfileBannerCollection(ProfileBanner::paginate(50));
    }

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
     *     summary="Get a profile banner",
     *     tags={"Profile Banners"},
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

    public function store(StoreProfileBannerRequest $request): JsonResponse
    {
        $profileBanner = ProfileBanner::create($request->validated());

        return response()->json(
            new ProfileBannerResource($profileBanner),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateProfileBannerRequest $request, ProfileBanner $profileBanner): JsonResponse
    {
        $profileBanner->update($request->validated());

        return response()->json(
            new ProfileBannerResource($profileBanner->refresh())
        );
    }
}
