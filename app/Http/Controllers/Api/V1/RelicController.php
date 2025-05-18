<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelicRequest;
use App\Http\Requests\UpdateRelicRequest;
use App\Http\Resources\Api\V1\RelicCollection;
use App\Http\Resources\Api\V1\RelicResource;
use App\Models\Relic;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as Http;

/**
 * @property array{
 *     name: string,
 *     tier_id: int,
 *     bonus_type_id: int,
 *     value: float,
 *     unlock_condition: ?string
 * } $validated
 */
class RelicController extends Controller
{
    /* ---------------------------------------------------------------------
     |  Destroy  –  DELETE /api/v1/relics/{relic}
     |---------------------------------------------------------------------*/
    public function destroy(Relic $relic): Response
    {
        $relic->delete();

        return response()->noContent();
    }

    /* ---------------------------------------------------------------------
     |  Index  –  GET /api/v1/relics
     |---------------------------------------------------------------------*/
    public function index(): RelicCollection
    {
        return new RelicCollection(
            Relic::with(['tier', 'bonuses'])->paginate(50)
        );
    }

    /* ---------------------------------------------------------------------
     |  Restore  –  PATCH /api/v1/relics/{id}/restore
     |---------------------------------------------------------------------*/
    public function restore(int|string $id): RelicResource|JsonResponse
    {
        /** @var Relic $relic */
        $relic = Relic::withTrashed()->findOrFail($id);

        if (!$relic->trashed()) {
            return response()->json([
                'message' => 'Relic is not deleted.',
            ], Http::HTTP_CONFLICT);
        }

        $relic->restore();

        return new RelicResource(
            $relic->load(['tier', 'bonuses'])
        );
    }

    /* ---------------------------------------------------------------------
     |  Show  –  GET /api/v1/relics/{relic}
     |---------------------------------------------------------------------*/
    public function show(Relic $relic): RelicResource
    {
        return new RelicResource(
            $relic->load(['tier', 'bonuses'])
        );
    }

    /* ---------------------------------------------------------------------
     |  Store  –  POST /api/v1/relics
     |---------------------------------------------------------------------*/
    public function store(StoreRelicRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Create Relic
        $relic = Relic::create([
            'name'             => $validated['name'],
            'tier_id'          => $validated['tier_id'],
            'unlock_condition' => $validated['unlock_condition'] ?? null,
        ]);

        // Attach bonus value via pivot
        $relic->bonuses()->attach([
            $validated['bonus_type_id'] => ['value' => $validated['value']],
        ]);

        return response()->json($relic->load(['tier', 'bonuses']), Response::HTTP_CREATED);
    }

    /* ---------------------------------------------------------------------
     |  Update  –  PUT/PATCH /api/v1/relics/{relic}
     |---------------------------------------------------------------------*/
    public function update(UpdateRelicRequest $request, Relic $relic): JsonResponse
    {
        $validated = $request->validated();

        // Update relic core fields
        $relic->update(array_filter([
            'name'             => $validated['name'] ?? null,
            'tier_id'          => $validated['tier_id'] ?? null,
            'unlock_condition' => $validated['unlock_condition'] ?? null,
        ], static fn ($v) => $v !== null));

        // Update bonus pivot if provided
        if ($request->filled('bonus_type_id') || $request->filled('value')) {
            // Detach old
            $relic->bonuses()->detach();

            // Get the bonus type ID and value
            $bonusTypeId = $validated['bonus_type_id'] ?? $relic->bonuses()->first()?->id;
            $bonusValue  = $validated['value'] ?? $relic->bonuses()->first()?->pivot?->value;

            if ($bonusTypeId !== null && $bonusValue !== null) {
                // Attach new / same type with possibly new value
                $relic->bonuses()->attach([
                    $bonusTypeId => ['value' => $bonusValue],
                ]);
            }
        }

        return response()->json($relic->refresh()->load(['tier', 'bonuses']));
    }
}
