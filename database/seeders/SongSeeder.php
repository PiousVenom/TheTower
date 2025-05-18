<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = [
            ['name' => 'Krisu - Oceans Sings',          'value' => 0.006],
            ['name' => 'Krisu - Hiding in Himalaya',    'value' => 0.006],
            ['name' => 'Krisu - Forest Bathing',        'value' => 0.006],
        ];

        // Sort by name for consistent ordering
        usort($songs, static fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        foreach ($songs as $song) {
            Song::factory()->create($song);
        }
    }
}
