<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Place;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $place_id = Place::all()->random()->id;
        $history = "";

        $random_enemy_id = Character::where('enemy',true)->get()->random()->id;
        $game = Game::create([
            'user_id' => $user_id,
            'place_id' => $place_id,
            'history' => $history,
        ]);
        $game -> characters() -> syncWithPivotValues([$request['character_id'],$random_enemy_id], ['hero_hp' => 20,'enemy_hp' => 20]);
        return view("games.show", ['game' => $game]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        Gate::authorize('view',$game,User::class);
        return view("games.show", ['game' => $game]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    public function attack(Request $request, Game $game)
    {
        function calculateDamage(&$att,&$def, $attackType, &$game){
            $damage = 0;
            if($attackType == "melee"){
                $damage = ($att->strength * 0.7 + $att->accuracy * 0.1 + $att->magic * 0.1) - $def->defence;
            }elseif($attackType == "ranged"){
                $damage = ($att->strength * 0.0 + $att->accuracy * 0.7 + $att->magic * 0.1) - $def->defence;
            }elseif($attackType == "special"){
                $damage = ($att->strength * 0.1 + $att->accuracy * 0.1 + $att->magic * 0.7) - $def->defence;
            }
            return $damage > 0 ? $damage : 0;
        }
        $character = $game->characters()->first();
        $enemy = $game->characters()->skip(1)->first();
        $attackType = $request['attackType'];

        // CHARACTER ATTACKS ONE
        $character_damage = calculateDamage($character,$enemy,$attackType,$game);
        $character ->pivot->enemy_hp -= $character_damage;
        $enemy->pivot->enemy_hp -= $character_damage;
        if($character ->pivot->enemy_hp <= 0){
            $game ->win = true;
            $character ->pivot->enemy_hp = 0;
            $enemy->pivot->enemy_hp = 0;
        }

        //ENEMY ATTACKS BACK INSTANTLY
        $attackTypes = ['melee','ranged','magic'];
        $random_attackType = $attackTypes[rand(0,2)];
        $enemy_damage = calculateDamage($enemy,$character,$random_attackType,$game);
        $character ->pivot->hero_hp -= $enemy_damage;
        $enemy ->pivot->hero_hp -= $enemy_damage;
        if($enemy ->pivot->hero_hp <= 0){
            $game ->win = false;
            $character ->pivot->hero_hp = 0;
            $enemy->pivot->hero_hp = 0;
        }

        $game->history = "";
        $game -> characters() -> syncWithPivotValues([$character->id,$enemy->id], ['hero_hp' => $character->pivot->hero_hp,'enemy_hp' => $character->pivot->enemy_hp]);
        $game -> history .= " ".$character->name.": ".$attackType." - " . $character_damage . " damage";
        $game -> history .= " ".$enemy->name.": ".$random_attackType." - " . $enemy_damage . " damage";
        $game->update(['win' => $game->win, 'history' => $game->history]);
        return view("games.show", ['game' => $game]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
