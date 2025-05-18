<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTierRequest;
use App\Http\Requests\Api\V1\UpdateTierRequest;
use App\Http\Resources\Api\V1\TierCollection;
use App\Http\Resources\Api\V1\TierResource;
use App\Models\Tier;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TierController extends Controller
{
    public function destroy(Tier $tier): Response
    {
        $tier->delete();

        return response()->noContent();
    }

    public function index(): TierCollection
    {
        return new TierCollection(Tier::paginate(50));
    }

    public function restore(int|string $id): JsonResponse
    {
        /** @var Tier $tier */
        $tier = Tier::withTrashed()->findOrFail($id);

        if (!$tier->trashed()) {
            return response()->json(
                ['message' => 'Tier is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $tier->restore();

        return response()->json(new TierResource($tier));
    }

    public function show(Tier $tier): TierResource
    {
        return new TierResource($tier);
    }

    public function store(StoreTierRequest $request): JsonResponse
    {
        $tier = Tier::create($request->validated());

        return response()->json(
            new TierResource($tier),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateTierRequest $request, Tier $tier): JsonResponse
    {
        $tier->update($request->validated());

        return response()->json(new TierResource($tier->refresh()));
    }
}
