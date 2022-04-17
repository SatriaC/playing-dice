<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'order',
        'player',
        'dice',
    ];

    public function players()
    {
        # code...
        return $this->belongsTo(Player::class, 'player');
    }
}
