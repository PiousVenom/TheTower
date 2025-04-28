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
            'Attack Speed', 'Cash', 'Coins', 'Crit Chance', 'Crit Factor',
            'Damage', 'Damage / Meter', 'Defense Absolute', 'Free Attack Upgrade',
            'Free Defense Upgrade', 'Free Utility Upgrade', 'Health', 'Health Regen', 'Lab Speed',
            'Orb Speed', 'Recovery Amount', 'Super Critical Chance', 'Super Critical Mult',
            'Thorns', 'Ultimate Damage', 'Wall Rebuild', 'Bot Range', 'Enemy Attack Level Skip'
        ];

        sort($types);

        foreach ($types as $name) {
            BonusType::factory()->create($name);
        }
    }
}
