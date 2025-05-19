<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'Dark Being', 'value' => 0.006],
            ['name' => 'Mech World', 'value' => 0.006],
        ];

        // Sort by name for consistent ordering
        usort($menus, static fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        foreach ($menus as $menu) {
            Menu::factory()->create($menu);
        }
    }
}
