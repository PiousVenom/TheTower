<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BackgroundSkin;
use Illuminate\Database\Seeder;

class BackgroundSkinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skins = [
            ['name' => 'Abduction',       'event_name' => 'Abduction',           'value' => 0.008],
            ['name' => 'Alien Ship',      'event_name' => 'Aliens',              'value' => 0.008],
            ['name' => 'Arcade',          'event_name' => 'Retro Arcade',        'value' => 0.008],
            ['name' => 'Aurora',          'event_name' => 'Aurora',              'value' => 0.008],
            ['name' => 'Autumn Forest',   'event_name' => 'Autumn',              'value' => 0.008],
            ['name' => 'Clock Tower',     'event_name' => 'What Time Is It?',    'value' => 0.008],
            ['name' => 'Cobweb',          'event_name' => 'Cobweb',              'value' => 0.008],
            ['name' => 'Dark Strands',    'event_name' => 'Dark Strands',        'value' => 0.008],
            ['name' => 'Deep Sea',        'event_name' => 'Deep Blue Sea',       'value' => 0.008],
            ['name' => 'Easter',          'event_name' => 'Easter',              'value' => 0.008],
            ['name' => 'Event Horizon',   'event_name' => 'Gravity',             'value' => 0.008],
            ['name' => 'Forest of Cats',  'event_name' => 'Meowy Night',         'value' => 0.008],
            ['name' => 'Haunted House',   'event_name' => 'Halloween',           'value' => 0.008],
            ['name' => 'Honeycomb',       'event_name' => 'Honey',               'value' => 0.008],
            ['name' => 'Hurricane',       'event_name' => 'Into The Storm',      'value' => 0.008],
            ['name' => 'Hyper Space',     'event_name' => 'Faster Than Light',   'value' => 0.008],
            ['name' => 'Interstellar',    'event_name' => 'Interstellar',        'value' => 0.008],
            ['name' => 'Invasion',        'event_name' => 'Invaders',            'value' => 0.008],
            ['name' => 'Matrix',          'event_name' => 'Into the Matrix',     'value' => 0.008],
            ['name' => 'Mech World',      'event_name' => 'Guild Season 2',      'value' => 0.008],
            ['name' => 'Mountain Night',  'event_name' => 'Full Moon',           'value' => 0.008],
            ['name' => 'New Year',        'event_name' => 'New Year',            'value' => 0.008],
            ['name' => 'Ocean Night',     'event_name' => 'Ocean Night',         'value' => 0.008],
            ['name' => 'Pi Disk',         'event_name' => 'Pi',                  'value' => 0.008],
            ['name' => 'Plasma',          'event_name' => 'Plasma Returns',      'value' => 0.008],
            ['name' => 'Prismatic Lines', 'event_name' => 'Prismatic Lines',     'value' => 0.008],
            ['name' => 'Rainfall',        'event_name' => 'Rainfall',            'value' => 0.008],
            ['name' => 'Retrowave',       'event_name' => 'Retrowave',           'value' => 0.008],
            ['name' => 'Sandstorm',       'event_name' => 'Sands of Time',       'value' => 0.008],
            ['name' => 'Sakura',          'event_name' => 'Sakura',              'value' => 0.008],
            ['name' => 'Snowstorm',       'event_name' => 'Snowstorm',           'value' => 0.008],
            ['name' => 'Sunset River',    'event_name' => 'Sunset Fishing',      'value' => 0.008],
            ['name' => 'Throne Room',     'event_name' => 'Guild Season 1',      'value' => 0.008],
            ['name' => 'TV Wall',         'event_name' => "Tower's Channel",     'value' => 0.008],
            ['name' => 'Volcano',         'event_name' => 'Volcano',             'value' => 0.008],
            ['name' => 'Virus Field',     'event_name' => 'Viral Outbreak',      'value' => 0.008],
        ];

        // Sort by name for consistent ordering
        usort($skins, static fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        foreach ($skins as $skin) {
            BackgroundSkin::factory()->create($skin);
        }
    }
}
