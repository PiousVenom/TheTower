<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBackgroundSkinRequest;
use App\Http\Requests\Api\V1\UpdateBackgroundSkinRequest;
use App\Models\BackgroundSkin;

class BackgroundSkinController extends Controller
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
    public function destroy(BackgroundSkin $backgroundSkin): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BackgroundSkin $backgroundSkin): void
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
    public function show(BackgroundSkin $backgroundSkin): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBackgroundSkinRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBackgroundSkinRequest $request, BackgroundSkin $backgroundSkin): void
    {
    }
}
