<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $map = \App\Map::create([
            'title' => 'Right bank of the Dnipro river',
            'description' => 'Well, I love travelling (who doesn\'t?) but this year I had too little time to plan, so the decision was quite obvious - why not to travel the Homeland. So here we go.',
            'center' => '49.432412580248,26.861572265625',
            'zoom' => 8,
            'user_id' => 1,
            'is_public' => 1,
            'photo' => 'http://i.imgur.com/5n00baG.jpg'
        ]);
        \App\Point::create([
            'description' => 'First stop. Feeling happy and having no idea what\'s awaiting us ahead.',
            'coordinates' => '49.83798245308484,24.049072265625',
            'map_id' => $map->id,
            'order' => 0
        ]);
        \App\Point::create([
            'description' => 'Things are getting more and more interesting. The road is extremely bad though!',
            'coordinates' => '49.78126405817837,24.9114990234375',
            'map_id' => $map->id,
            'order' => 1
        ]);
        \App\Point::create([
            'description' => '',
            'coordinates' => '49.54303352434694,25.59814453125',
            'map_id' => $map->id,
            'order' => 2
        ]);
        \App\Point::create([
            'description' => '<img src="http://i.imgur.com/5n00baG.jpg" width="100%" />',
            'coordinates' => '49.50024216453777,26.1859130859375',
            'map_id' => $map->id,
            'order' => 3
        ]);
        \App\Point::create([
            'description' => '',
            'coordinates' => '49.41812070066643,26.9989013671875',
            'map_id' => $map->id,
            'order' => 4
        ]);
        \App\Point::create([
            'description' => 'No one would expect it, but yes - the sun finally came out and we were ready to move on.',
            'coordinates' => '49.23912083246698,27.4273681640625',
            'map_id' => $map->id,
            'order' => 5
        ]);
        \App\Point::create([
            'description' => '',
            'coordinates' => '49.06306925171648,27.696533203125',
            'map_id' => $map->id,
            'order' => 6
        ]);
        \App\Point::create([
            'description' => '',
            'coordinates' => '49.03786794532644,28.1634521484375',
            'map_id' => $map->id,
            'order' => 7
        ]);
        \App\Point::create([
            'description' => 'And the story ends here. You have no idea about trip yet - no warnings though (as this story was built for demo purposes only ;) )',
            'coordinates' => '49.221185044221336,28.465576171875',
            'map_id' => $map->id,
            'order' => 8
        ]);
    }
}
