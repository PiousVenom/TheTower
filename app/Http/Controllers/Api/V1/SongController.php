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
 *     name="Songs"
 * )
 */
class SongController extends Controller
{
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

    public function store(StoreSongRequest $request): JsonResponse
    {
        $song = Song::create($request->validated());

        return response()->json(
            new SongResource($song),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateSongRequest $request, Song $song): JsonResponse
    {
        $song->update($request->validated());

        return response()->json(
            new SongResource($song->refresh())
        );
    }
}
