<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BonusType;
use Illuminate\Database\Seeder;

class BonusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Attack Speed'],
            ['name' => 'Cash'],
            ['name' => 'Coins'],
            ['name' => 'Crit Chance'],
            ['name' => 'Crit Factor'],
            ['name' => 'Damage'],
            ['name' => 'Damage / Meter'],
            ['name' => 'Defense Absolute'],
            ['name' => 'Free Attack Upgrade'],
            ['name' => 'Free Defense Upgrade'],
            ['name' => 'Free Utility Upgrade'],
            ['name' => 'Health'],
            ['name' => 'Health Regen'],
            ['name' => 'Lab Speed'],
            ['name' => 'Orb Speed'],
            ['name' => 'Recovery Amount'],
            ['name' => 'Super Critical Chance'],
            ['name' => 'Super Critical Mult'],
            ['name' => 'Thorns'],
            ['name' => 'Ultimate Damage'],
            ['name' => 'Wall Rebuild'],
            ['name' => 'Bot Range'],
            ['name' => 'Enemy Attack Level Skip'],
        ];

        sort($types);

        foreach ($types as $type) {
            BonusType::factory()->create($type);
        }
    }
}
