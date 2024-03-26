<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'win',
        'user_id',
        'place_id',
        'history'
    ];

    public function place(){
        return $this->belongsTo(Place::class);
    }
    public function characters()
    {
        return $this->belongsToMany(Character::class)->withPivot('hero_hp', 'enemy_hp')->withTimestamps();
    }
}
