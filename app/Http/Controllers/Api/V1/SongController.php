<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSongRequest;
use App\Http\Requests\Api\V1\UpdateSongRequest;
use App\Http\Resources\Api\V1\SongCollection;
use App\Http\Resources\Api\V1\SongResource;
use App\Models\Song;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Songs",
 *     description="Manage available songs"
 * )
 */
class SongController extends Controller
{
    /**
     * Soft-delete a song.
     *
     * @OA\Delete(
     *     path="/songs/{id}",
     *     summary="Delete song",
     *     tags={"Songs"},
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
    public function destroy(Song $song): Response
    {
        $song->delete();

        return response()->noContent();
    }

    /**
     * List songs (paginated).
     *
     * @OA\Get(
     *     path="/songs",
     *     summary="List songs",
     *     tags={"Songs"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of songs",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SongCollection")
     *     )
     * )
     */
    public function index(): SongCollection
    {
        return new SongCollection(Song::paginate(50));
    }

    /**
     * Restore a soft-deleted song.
     *
     * @OA\Patch(
     *     path="/songs/{id}/restore",
     *     summary="Restore song",
     *     tags={"Songs"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Restored song",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *
     *     @OA\Response(response=409, description="Song is not deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function restore(int|string $id): JsonResponse
    {
        $song = Song::withTrashed()->findOrFail($id);

        if (!$song->trashed()) {
            return response()->json(
                ['message' => 'Song is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $song->restore();

        return response()->json(
            new SongResource($song)
        );
    }

    /**
     * Retrieve a single song.
     *
     * @OA\Get(
     *     path="/songs/{id}",
     *     summary="Get a song",
     *     tags={"Songs"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Song detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Song $song): SongResource
    {
        return new SongResource($song);
    }

    /**
     * Create a new song.
     *
     * @OA\Post(
     *     path="/songs",
     *     summary="Create song",
     *     tags={"Songs"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreSongRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(StoreSongRequest $request): JsonResponse
    {
        $song = Song::create($request->validated());

        return response()->json(
            new SongResource($song),
            Response::HTTP_CREATED
        );
    }

    /**
     * Update an existing song.
     *
     * @OA\Patch(
     *     path="/songs/{id}",
     *     summary="Update song",
     *     tags={"Songs"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateSongRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Updated song",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SongResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(UpdateSongRequest $request, Song $song): JsonResponse
    {
        $song->update($request->validated());

        return response()->json(
            new SongResource($song->refresh())
        );
    }
}
