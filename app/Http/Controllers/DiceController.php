<?php

namespace App\Http\Controllers;

use App\Models\Dice;
use App\Models\Player;
use App\Services\DiceService;
use Illuminate\Http\Request;

class DiceController extends Controller
{
    protected $service;

    public function __construct(
        DiceService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        # code...
        return view('pages.dice.index');
    }

    public function play()
    {
        # code...
        $rolls = Player::find(1)->amount_dice;
        $countdown = Player::find(1)->count_down;
        $winner2 = Player::orderBy('points', 'desc')->first();
        $players = Player::all();
        $dice = [];
        $winners = [];
        foreach ($players as $keyP => $player) {
            $order = Dice::where('player', $player->id)->orderBy('order', 'desc')->pluck('order');
            # code...
            // $order[0];
            for ($i = 0; $i < $order[0]; $i++) {
                # code...
                $dice[$keyP][$i] = Dice::where([['order', $i + 1], ['player', $player->id]])->orderBy('order', 'asc')->get();
            }
            if ($player->has_dice == 0) {
                # code...
                array_push($winners, $player->id);
            }
        }
        return view('pages.dice.play', compact(['dice', 'order', 'players', 'rolls', 'winners', 'winner2', 'countdown']));
    }

    public function store(Request $request)
    {
        # code...
        return $this->service->store($request);
    }

    public function count($id)
    {
        # code...
        return $this->service->count($id);
    }

    public function roll()
    {
        # code...
        return $this->service->roll();
    }
    
    public function reset()
    {
        # code...
        return $this->service->reset();
    }
}
