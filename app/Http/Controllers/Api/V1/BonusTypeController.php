<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusTypeRequest;
use App\Http\Requests\UpdateBonusTypeRequest;
use App\Models\BonusType;

class BonusTypeController extends Controller
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
    public function destroy(BonusType $bonusType): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BonusType $bonusType): void
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
    public function show(BonusType $bonusType): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBonusTypeRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBonusTypeRequest $request, BonusType $bonusType): void
    {
    }
}
