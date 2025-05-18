<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RelicCollection;
use App\Http\Resources\Api\V1\RelicResource;
use App\Models\Relic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as Http;

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
    public function restore(int|string $id): JsonResponse
    {
        $relic = Relic::withTrashed()->findOrFail($id);

        if (!$relic->trashed()) {
            return response()->json([
                'message' => 'Relic is not deleted.',
            ], Http::HTTP_CONFLICT);
        }

        $relic->restore();

        return (new RelicResource($relic->refresh()->load(['tier', 'bonuses'])))->response();
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
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:191', 'unique:relics,name'],
            'tier_id'          => ['required', 'exists:tiers,id'],
            'bonus_type_id'    => ['required', 'exists:bonus_types,id'],
            'value'            => ['required', 'numeric', 'between:0,9999.9999'],
            'unlock_condition' => ['nullable', 'string'],
        ]);

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
    public function update(Request $request, Relic $relic): JsonResponse
    {
        $validated = $request->validate([
            'name'             => ['sometimes', 'string', 'max:191', Rule::unique('relics', 'name')->ignore($relic->id)],
            'tier_id'          => ['sometimes', 'exists:tiers,id'],
            'bonus_type_id'    => ['sometimes', 'exists:bonus_types,id'],
            'value'            => ['sometimes', 'numeric', 'between:0,9999.9999'],
            'unlock_condition' => ['nullable', 'string'],
        ]);

        // Update relic core fields
        $relic->update($request->only(['name', 'tier_id', 'unlock_condition']));

        // Update bonus pivot if provided
        if ($request->filled('bonus_type_id') || $request->filled('value')) {
            // Detach old
            $relic->bonuses()->detach();
            // Attach new / same type with possibly new value
            $relic->bonuses()->attach([
                $validated['bonus_type_id'] ?? $relic->bonuses()->first()->id => [
                    'value' => $validated['value'] ?? $relic->bonus()?->pivot->value,
                ],
            ]);
        }

        return response()->json($relic->refresh()->load(['tier', 'bonuses']));
    }
}
