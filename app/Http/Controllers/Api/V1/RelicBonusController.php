<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelicBonusRequest;
use App\Http\Requests\UpdateRelicBonusRequest;
use App\Models\RelicBonus;

class RelicBonusController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RelicBonus $relicBonus): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RelicBonus $relicBonus): void
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(RelicBonus $relicBonus): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRelicBonusRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelicBonusRequest $request, RelicBonus $relicBonus): void
    {
    }
}
