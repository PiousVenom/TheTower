<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Guardian;
use Illuminate\Database\Seeder;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardians = [
            ['name' => 'Butter', 'value' => 0.006],
            ['name' => 'Muse',   'value' => 0.006],
            ['name' => 'Finn',   'value' => 0.006],
        ];

        // Sort by name for consistent ordering
        usort($guardians, static fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        foreach ($guardians as $guardian) {
            Guardian::factory()->create($guardian);
        }
    }
}
