<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'user_id',
        'magic'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function games()
    {
        return $this->belongsToMany(Game::class)->withPivot('hero_hp', 'enemy_hp')->withTimestamps();
    }
}
