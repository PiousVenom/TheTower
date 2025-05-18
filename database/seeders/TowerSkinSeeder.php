<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\TowerSkin;
use Illuminate\Database\Seeder;

class TowerSkinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skins = [
            ['name' => 'Alien',           'event_name' => 'Aliens',              'value' => 0.004],
            ['name' => 'Autumn Leaf',     'event_name' => 'Autumn',              'value' => 0.004],
            ['name' => 'Bee',             'event_name' => 'Honey',               'value' => 0.004],
            ['name' => 'Black Cat',       'event_name' => 'Meowy Night',         'value' => 0.004],
            ['name' => 'Black Hole',      'event_name' => 'Gravity',             'value' => 0.004],
            ['name' => 'Bunny',           'event_name' => 'Easter',              'value' => 0.004],
            ['name' => 'Cherry Blossom',  'event_name' => 'Sakura',              'value' => 0.004],
            ['name' => 'Crown',           'event_name' => 'Guild Season 1',      'value' => 0.004],
            ['name' => 'Dark Tower',      'event_name' => 'Dark Strands',        'value' => 0.004],
            ['name' => 'Dive Helmet',     'event_name' => 'Deep Blue Sea',       'value' => 0.004],
            ['name' => 'Elite Tower',     'event_name' => 'Invaders',            'value' => 0.004],
            ['name' => 'Eye of the Lord', 'event_name' => 'Volcano',             'value' => 0.004],
            ['name' => 'Fisherman',       'event_name' => 'Sunset Fishing',      'value' => 0.004],
            ['name' => 'Howling Wolf',    'event_name' => 'Full Moon',           'value' => 0.004],
            ['name' => 'Hourglass',       'event_name' => 'Sands of Time',       'value' => 0.004],
            ['name' => 'Invader',         'event_name' => 'Retro Arcade',        'value' => 0.004],
            ['name' => 'Mech Warrior',    'event_name' => 'Guild Season 2',      'value' => 0.004],
            ['name' => 'Neo Turbo',       'event_name' => 'Retrowave',           'value' => 0.004],
            ['name' => 'Neon Pi',         'event_name' => 'Pi',                  'value' => 0.004],
            ['name' => 'North Spirit',    'event_name' => 'Aurora',              'value' => 0.004],
            ['name' => 'Noise Tower',     'event_name' => "Tower's Channel",     'value' => 0.004],
            ['name' => 'Pocket Watch',    'event_name' => 'What Time Is It?',    'value' => 0.004],
            ['name' => 'Plasma',          'event_name' => 'Plasma Returns',      'value' => 0.004],
            ['name' => 'Prisma',          'event_name' => 'Prismatic Lines',     'value' => 0.004],
            ['name' => 'Pumpkin',         'event_name' => 'Halloween',           'value' => 0.004],
            ['name' => 'Sentinel',        'event_name' => 'Into the Matrix',     'value' => 0.004],
            ['name' => 'Sky Star',        'event_name' => 'Interstellar',        'value' => 0.004],
            ['name' => 'Snowman',         'event_name' => 'Snowstorm',           'value' => 0.004],
            ['name' => 'Spider',          'event_name' => 'Cobweb',              'value' => 0.004],
            ['name' => 'Storm Eye',       'event_name' => 'Into The Storm',      'value' => 0.004],
            ['name' => 'Star',            'event_name' => 'Interstellar',        'value' => 0.004],
            ['name' => 'Starship',        'event_name' => 'Faster Than Light',   'value' => 0.004],
            ['name' => 'Toast Glass',     'event_name' => 'New Year',            'value' => 0.004],
            ['name' => 'Umbrella',        'event_name' => 'Rainfall',            'value' => 0.004],
            ['name' => 'Unlucky Cow',     'event_name' => 'Abduction',           'value' => 0.004],
            ['name' => 'Virus',           'event_name' => 'Viral Outbreak',      'value' => 0.004],
            ['name' => 'Water Droplet',   'event_name' => 'Ocean Night',         'value' => 0.004],
            ['name' => 'Shuriken',        'event_name' => 'Tier 1 Free',         'value' => 0.004],
            ['name' => 'Donut',           'event_name' => 'Tier 2 Pass 1',       'value' => 0.004],
            ['name' => 'Yin-Yang',        'event_name' => 'Tier 3 Free',         'value' => 0.004],
            ['name' => 'Smile',           'event_name' => 'Tier 4Free',          'value' => 0.004],
            ['name' => 'Butterfly',       'event_name' => 'Tier 5 Pass 2',       'value' => 0.004],
            ['name' => 'Sheep',           'event_name' => 'Tier 6 Free',         'value' => 0.004],
            ['name' => 'Fried Egg',       'event_name' => 'Tier 7 Free',         'value' => 0.004],
            ['name' => 'Mush-mush',       'event_name' => 'Tier 8 Pass 3',       'value' => 0.004],
            ['name' => 'Turtle',          'event_name' => 'Tier 9 Free',         'value' => 0.004],
            ['name' => 'Cheese',          'event_name' => 'Tier 10 Free',        'value' => 0.004],
            ['name' => 'Cat',             'event_name' => 'Tier 11 Pass 4',      'value' => 0.004],
            ['name' => 'Skull',           'event_name' => 'Tier 12 Free',        'value' => 0.004],
            ['name' => 'Creepy Clown',    'event_name' => 'Tier 13 Free',        'value' => 0.004],
            ['name' => 'Panda',           'event_name' => 'Tier 14 Pass 5',      'value' => 0.004],
            ['name' => 'Tech Tree',       'event_name' => 'Tier 15 Free',        'value' => 0.004],
            ['name' => 'Cactus',          'event_name' => 'Tier 16 Free',        'value' => 0.004],
            ['name' => 'Dragon',          'event_name' => 'Tier 17 Pass 6',      'value' => 0.004],
            ['name' => 'Rhino',           'event_name' => 'Tier 18 Free',        'value' => 0.004],
        ];

        // Sort by tower-skin name for consistency
        usort($skins, static fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        foreach ($skins as $skin) {
            TowerSkin::factory()->create($skin);
        }
    }
}
