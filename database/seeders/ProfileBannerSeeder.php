<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProfileBanner;
use Illuminate\Database\Seeder;

class ProfileBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profileBanners = [
            ['name' => 'Mech World', 'value' => 0.006],
        ];

        // Sort by name for consistent ordering
        usort($profileBanners, static fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        foreach ($profileBanners as $profileBanner) {
            ProfileBanner::factory()->create($profileBanner);
        }
    }
}
