<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BonusCategory;

class BonusCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Damage'],
            ['name' => 'Defense'],
            ['name' => 'Utility'],
            ['name' => 'Miscellaneous'],
        ];

        // Alphabetise so inserts are deterministic
        usort($categories, fn ($a, $b) => strcmp($a['name'], $b['name']));

        foreach ($categories as $category) {
            BonusCategory::factory()->create($category);
        }
    }
}
