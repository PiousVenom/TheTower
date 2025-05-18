<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreProfileBannerRequest;
use App\Http\Requests\Api\V1\UpdateProfileBannerRequest;
use App\Models\ProfileBanner;

class ProfileBannerController extends Controller
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
    public function destroy(ProfileBanner $profileBanner): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileBanner $profileBanner): void
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
    public function show(ProfileBanner $profileBanner): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileBannerRequest $request): void
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileBannerRequest $request, ProfileBanner $profileBanner): void
    {
    }
}
