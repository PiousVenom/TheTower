<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tier;
use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = [
            [
                'name' => 'Common',
            ],
            [
                'name' => 'Rare',
            ],
            [
                'name' => 'Epic',
            ],
            [
                'name' => 'Legendary',
            ],
            [
                'name' => 'Mythic',
            ],
            [
                'name' => 'Ancestral',
            ],
        ];

        foreach ($tiers as $tier) {
            Tier::factory()->create($tier);
        }
    }
}
