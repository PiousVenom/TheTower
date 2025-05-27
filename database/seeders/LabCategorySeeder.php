<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LabCategory;
use Illuminate\Database\Seeder;

class LabCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Main'],
            ['name' => 'Attack'],
            ['name' => 'Defense'],
            ['name' => 'Utility'],
            ['name' => 'Ultimate Weapons'],
            ['name' => 'Cards'],
            ['name' => 'Perks'],
            ['name' => 'Bots'],
            ['name' => 'Enemies'],
            ['name' => 'Modules'],
        ];

        foreach ($categories as $category) {
            LabCategory::factory()->create($category);
        }
    }
}
