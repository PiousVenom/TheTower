<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BonusCategory;
use Illuminate\Database\Seeder;

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
        usort($categories, static fn ($a, $b) => strcmp($a['name'], $b['name']));

        foreach ($categories as $category) {
            BonusCategory::factory()->create($category);
        }
    }
}
