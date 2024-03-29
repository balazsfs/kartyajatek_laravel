<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Character;
use App\Models\Place;
use App\Models\Game;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating admin
        $admin = User::create([
            'email' => 'admin@admin.com',
            'name' => 'admin',
            'password' => password_hash('admin',PASSWORD_DEFAULT),
            'admin' => true
        ]);

        $users = collect();
        //Creating 10 users
        for ($i = 0; $i < 10; $i++){
            $user = User::create([
                'email' => 'user'.$i.'@szerveroldali.hu',
                'name' => fake('hu_HU') -> name(),
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'admin' => false
            ]);
            $users -> add($user);
        }

        // Creating 25 characters

        $characters = collect();

        for ($i = 0; $i < 25; $i++){
            $def = rand(0,20);
            $strength = rand(0,20-$def);
            $accuracy = rand(0,20-($strength+$def));
            $magic = rand(0,20-($accuracy+$strength+$def));
            $character = Character::create([
                'name' => fake() -> name(),
                'enemy' => false,
                'defence' => $def,
                'strength' => $strength,
                'accuracy' => $accuracy,
                'user_id' => $users -> random() -> id,
                'magic' => $magic
            ]);
            $characters -> add($character);
        }

        // Creating 25 enemies
        $enemies = collect();

        for ($i = 0; $i < 25; $i++){
            $strength = rand(0,15);
            $accuracy = rand(0,15-$strength);
            $magic = rand(0,15-($strength+$accuracy));
            $def = 20-($accuracy+$strength+$magic);
            $enemy = Character::create([
                'name' => fake() -> name(),
                'enemy' => true,
                'defence' => $def,
                'strength' => $strength,
                'accuracy' => $accuracy,
                'user_id' => $admin -> id,
                'magic' => $magic
            ]);
            $enemies -> add($enemy);
        }

        //Creating 10 places
        $places = collect();

        for ($i = 0; $i < 10; $i++){
            $place = Place::create([
                'name' => fake() -> city(),
                'file_path' => 'background'.$i.'.png'
            ]);
            $places -> add($place);
        }

        //Creating 50 Games

        $games = collect();

        for ($i = 0; $i < 50; $i++){
            $isWin = rand(0,1) == 1;
            $random_character = $characters->random(1);
            $game = Game::create([
                'win' => $isWin,
                'history' => fake() -> text(),
                'user_id' => $random_character->pluck('user_id')->implode(', '),
                'place_id' => $places -> random() ->id
            ]);
            $enemy_hero_merged_ids = $random_character->pluck('id')-> merge($enemies->random(1)->pluck('id'));
            $game -> characters() -> syncWithPivotValues($enemy_hero_merged_ids, ['hero_hp' => $isWin ? rand(1,20) : 0,'enemy_hp' => $isWin ? 0 : rand(1,20)]);

            $games -> add($game);
        }
    }
}
