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
 *     name="Guardians"
 * )
 */
class GuardianController extends Controller
{
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

    public function store(StoreGuardianRequest $request): JsonResponse
    {
        $guardian = Guardian::create($request->validated());

        return response()->json(
            new GuardianResource($guardian),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateGuardianRequest $request, Guardian $guardian): JsonResponse
    {
        $guardian->update($request->validated());

        return response()->json(
            new GuardianResource($guardian->refresh())
        );
    }
}
