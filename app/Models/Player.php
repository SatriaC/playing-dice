<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'amount_dice',
        'has_dice',
        'points',
        'count_down'
    ];

    public function dices()
    {
        # code...
        return $this->hasMany(Dice::class, 'player');
    }
}
