<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreGuardianRequest;
use App\Http\Requests\Api\V1\UpdateGuardianRequest;
use App\Models\Guardian;

class GuardianController extends Controller
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
    public function destroy(Guardian $guardian): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian): void
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
    public function show(Guardian $guardian): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuardianRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianRequest $request, Guardian $guardian): void
    {
    }
}
