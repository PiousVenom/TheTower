<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBonusTypeRequest;
use App\Http\Requests\Api\V1\UpdateBonusTypeRequest;
use App\Http\Resources\Api\V1\BonusTypeCollection;
use App\Http\Resources\Api\V1\BonusTypeResource;
use App\Models\BonusType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BonusTypeController extends Controller
{
    public function destroy(BonusType $bonusType): Response
    {
        $bonusType->delete();

        return response()->noContent();
    }

    public function index(): BonusTypeCollection
    {
        return new BonusTypeCollection(
            BonusType::with('category')->paginate(50)
        );
    }

    public function restore(int|string $id): JsonResponse
    {
        /** @var BonusType $bonusType */
        $bonusType = BonusType::withTrashed()->findOrFail($id);

        if (!$bonusType->trashed()) {
            return response()->json(
                ['message' => 'Bonus type is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $bonusType->restore();

        return response()->json(
            new BonusTypeResource($bonusType->load('category'))
        );
    }

    public function show(BonusType $bonusType): BonusTypeResource
    {
        return new BonusTypeResource(
            $bonusType->load('category')
        );
    }

    public function store(StoreBonusTypeRequest $request): JsonResponse
    {
        $validated  = $request->validated();
        $bonusType  = BonusType::create($validated);

        return response()->json(
            new BonusTypeResource($bonusType->load('category')),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateBonusTypeRequest $request, BonusType $bonusType): JsonResponse
    {
        $bonusType->update($request->validated());

        return response()->json(
            new BonusTypeResource($bonusType->refresh()->load('category'))
        );
    }
}
