<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSongRequest;
use App\Http\Requests\Api\V1\UpdateSongRequest;
use App\Models\Song;

class SongController extends Controller
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
    public function destroy(Song $song): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song): void
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
    public function show(Song $song): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSongRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSongRequest $request, Song $song): void
    {
    }
}
