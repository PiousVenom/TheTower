<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTierRequest;
use App\Http\Requests\Api\V1\UpdateTierRequest;
use App\Models\Tier;

class TierController extends Controller
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
    public function destroy(Tier $tier): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tier $tier): void
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
    public function show(Tier $tier): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTierRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTierRequest $request, Tier $tier): void
    {
    }
}
