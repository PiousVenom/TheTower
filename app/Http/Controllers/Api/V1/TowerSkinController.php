<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTowerSkinRequest;
use App\Http\Requests\Api\V1\UpdateTowerSkinRequest;
use App\Models\TowerSkin;

class TowerSkinController extends Controller
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
    public function destroy(TowerSkin $towerSkin): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TowerSkin $towerSkin): void
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
    public function show(TowerSkin $towerSkin): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTowerSkinRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTowerSkinRequest $request, TowerSkin $towerSkin): void
    {
    }
}
