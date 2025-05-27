<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreLabRequest;
use App\Http\Requests\Api\V1\UpdateLabRequest;
use App\Http\Resources\Api\V1\LabCollection;
use App\Http\Resources\Api\V1\LabResource;
use App\Models\Lab;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Labs"
 * )
 */
class LabController extends Controller
{
    public function destroy(Lab $lab): Response
    {
        $lab->delete();

        return response()->noContent();
    }

    /**
     * List labs (paginated).
     *
     * @OA\Get(
     *     path="/labs",
     *     summary="List labs",
     *     tags={"Labs"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of labs",
     *
     *         @OA\JsonContent(ref="#/components/schemas/LabCollection")
     *     )
     * )
     */
    public function index(): LabCollection
    {
        return new LabCollection(
            Lab::with(['category', 'levels'])->paginate(50)
        );
    }

    public function restore(int|string $id): JsonResponse
    {
        $lab = Lab::withTrashed()->findOrFail($id);

        if (!$lab->trashed()) {
            return response()->json(
                ['message' => 'Lab is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $lab->restore();

        return response()->json(
            new LabResource($lab->load(['category', 'levels']))
        );
    }

    /**
     * Retrieve a single lab.
     *
     * @OA\Get(
     *     path="/labs/{id}",
     *     summary="Get a lab",
     *     tags={"Labs"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lab detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/LabResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Lab $lab): LabResource
    {
        return new LabResource(
            $lab->load(['category', 'levels'])
        );
    }

    public function store(StoreLabRequest $request): JsonResponse
    {
        $lab = Lab::create($request->validated())
            ->load(['category', 'levels']);

        return response()->json(
            new LabResource($lab),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateLabRequest $request, Lab $lab): JsonResponse
    {
        $lab->update($request->validated());

        return response()->json(
            new LabResource(
                $lab->refresh()->load(['category', 'levels'])
            )
        );
    }
}
