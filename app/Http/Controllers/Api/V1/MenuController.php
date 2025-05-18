<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreMenuRequest;
use App\Http\Requests\Api\V1\UpdateMenuRequest;
use App\Models\Menu;

class MenuController extends Controller
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
    public function destroy(Menu $menu): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu): void
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
    public function show(Menu $menu): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu): void
    {
    }
}
