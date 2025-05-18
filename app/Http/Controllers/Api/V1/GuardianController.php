<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreGuardianRequest;
use App\Http\Requests\Api\V1\UpdateGuardianRequest;
use App\Http\Resources\Api\V1\GuardianCollection;
use App\Http\Resources\Api\V1\GuardianResource;
use App\Models\Guardian;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Guardians",
 *     description="Manage available guardians"
 * )
 */
class GuardianController extends Controller
{
    /**
     * Soft-delete a guardian.
     *
     * @OA\Delete(
     *     path="/guardians/{id}",
     *     summary="Delete guardian",
     *     tags={"Guardians"},
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
    public function destroy(Guardian $guardian): Response
    {
        $guardian->delete();

        return response()->noContent();
    }

    /**
     * List guardians (paginated).
     *
     * @OA\Get(
     *     path="/guardians",
     *     summary="List guardians",
     *     tags={"Guardians"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of guardians",
     *
     *         @OA\JsonContent(ref="#/components/schemas/GuardianCollection")
     *     )
     * )
     */
    public function index(): GuardianCollection
    {
        return new GuardianCollection(Guardian::paginate(50));
    }

    /**
     * Restore a soft-deleted guardian.
     *
     * @OA\Patch(
     *     path="/guardians/{id}/restore",
     *     summary="Restore guardian",
     *     tags={"Guardians"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Restored guardian",
     *
     *         @OA\JsonContent(ref="#/components/schemas/GuardianResource")
     *     ),
     *
     *     @OA\Response(response=409, description="Guardian is not deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function restore(int|string $id): JsonResponse
    {
        $guardian = Guardian::withTrashed()->findOrFail($id);

        if (!$guardian->trashed()) {
            return response()->json(
                ['message' => 'Guardian is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $guardian->restore();

        return response()->json(
            new GuardianResource($guardian)
        );
    }

    /**
     * Retrieve a single guardian.
     *
     * @OA\Get(
     *     path="/guardians/{id}",
     *     summary="Get a guardian",
     *     tags={"Guardians"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Guardian detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/GuardianResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Guardian $guardian): GuardianResource
    {
        return new GuardianResource($guardian);
    }

    /**
     * Create a new guardian.
     *
     * @OA\Post(
     *     path="/guardians",
     *     summary="Create guardian",
     *     tags={"Guardians"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreGuardianRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(ref="#/components/schemas/GuardianResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreGuardianRequest $request): JsonResponse
    {
        $guardian = Guardian::create($request->validated());

        return response()->json(
            new GuardianResource($guardian),
            Response::HTTP_CREATED
        );
    }

    /**
     * Update an existing guardian.
     *
     * @OA\Patch(
     *     path="/guardians/{id}",
     *     summary="Update guardian",
     *     tags={"Guardians"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateGuardianRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Updated guardian",
     *
     *         @OA\JsonContent(ref="#/components/schemas/GuardianResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian): JsonResponse
    {
        $guardian->update($request->validated());

        return response()->json(
            new GuardianResource($guardian->refresh())
        );
    }
}
