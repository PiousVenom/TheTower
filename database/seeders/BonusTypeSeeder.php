<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BonusCategory;
use App\Models\BonusType;
use Illuminate\Database\Seeder;

class BonusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* -------------------------------------------------------------
         | 1. Fetch or create the four categories and cache their IDs
         * -----------------------------------------------------------*/
        $categoryIds = collect([
            'Damage',
            'Defense',
            'Utility',
            'Miscellaneous',
        ])->mapWithKeys(static fn ($name) => [
            $name => BonusCategory::firstOrCreate(['name' => $name])->id,
        ]);

        /* -------------------------------------------------------------
         | 2. Define every bonus type with its unit + category
         * -----------------------------------------------------------*/
        $types = [
            /* ─── Misc (economy-style bonuses) ───────────────────────── */
            ['name' => 'Bot Range',               'unit' => 'flat',       'bonus_category_id' => $categoryIds['Miscellaneous']],
            ['name' => 'Lab Speed',               'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Miscellaneous']],

            /* ─── Damage ──────────────────────────────────────────────── */
            ['name' => 'Damage',                  'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Ultimate Damage',         'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Attack Speed',            'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Crit Chance',             'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Crit Factor',             'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Damage / Meter',          'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Super Critical Chance',   'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],
            ['name' => 'Super Critical Mult',     'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Damage']],

            /* ─── Defense ─────────────────────────────────────────────── */
            ['name' => 'Health',                  'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Defense']],
            ['name' => 'Health Regen',            'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Defense']],
            ['name' => 'Defense Absolute',        'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Defense']],
            ['name' => 'Thorns',                  'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Defense']],
            ['name' => 'Knockback Force',         'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Defense']],
            ['name' => 'Orb Speed',               'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Defense']],
            ['name' => 'Wall Rebuild',            'unit' => 'seconds',    'bonus_category_id' => $categoryIds['Defense']],

            /* ─── Utility ─────────────────────────────────────────────── */
            ['name' => 'Cash',                    'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Coins',                   'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Free Attack Upgrade',     'unit' => 'flat',       'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Free Defense Upgrade',    'unit' => 'flat',       'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Free Utility Upgrade',    'unit' => 'flat',       'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Recovery Amount',         'unit' => 'percentage', 'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Enemy Attack Level Skip', 'unit' => 'flat',       'bonus_category_id' => $categoryIds['Utility']],
            ['name' => 'Enemy Health Level Skip', 'unit' => 'flat',       'bonus_category_id' => $categoryIds['Utility']],
        ];

        /* -------------------------------------------------------------
         | 3. Sort alphabetically and seed
         * -----------------------------------------------------------*/
        usort($types, static fn ($a, $b) => strcmp($a['name'], $b['name']));

        foreach ($types as $type) {
            BonusType::factory()->create($type);
        }
    }
}
