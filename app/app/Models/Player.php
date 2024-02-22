<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'name',
        'login',
        'email',
        'password'
    ];

    protected $table = 'players';


    public function results()
    {
        return $this->belongsToMany(Result::class, 'player_results', 'players_id', 'results_id');
    }
}
