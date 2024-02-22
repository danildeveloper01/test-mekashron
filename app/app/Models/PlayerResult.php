<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerResult extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['player_id', 'result'];

    // Связь с моделью Player
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
