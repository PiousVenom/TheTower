<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonusCategoryRequest;
use App\Http\Requests\UpdateBonusCategoryRequest;
use App\Models\BonusCategory;

class BonusCategoryController extends Controller
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
    public function destroy(BonusCategory $bonusCategory): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BonusCategory $bonusCategory): void
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
    public function show(BonusCategory $bonusCategory): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBonusCategoryRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBonusCategoryRequest $request, BonusCategory $bonusCategory): void
    {
    }
}
