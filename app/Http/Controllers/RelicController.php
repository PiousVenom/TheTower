<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRelicRequest;
use App\Http\Requests\UpdateRelicRequest;
use App\Models\Relic;

class RelicController extends Controller
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
    public function destroy(Relic $relic): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relic $relic): void
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
    public function show(Relic $relic): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRelicRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelicRequest $request, Relic $relic): void
    {
    }
}
