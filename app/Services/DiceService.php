<?php

namespace App\Services;

use App\Helpers\Pagination;
use App\Models\Dice;
use App\Models\Pemrek\ReportAgent;
use App\Models\Player;
use App\Models\Reference;
use App\Repositories\DiceRepository;
use App\Repositories\PlayerRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiceService extends BaseService
{
    protected $repo;
    protected $repoPlayer;

    public function __construct(
        DiceRepository $repo,
        PlayerRepository $repoPlayer
    ) {
        parent::__construct();
        $this->repo = $repo;
        $this->repoPlayer = $repoPlayer;
    }

    public function all()
    {
        $data =  $this->repo->all();

        return Pagination::paginate($data);
    }


    public function store($request)
    {
        # code...
        $this->createPlayer($request);
        for ($j=1; $j <= $request->dice ; $j++) {
            # code...
            for ($i=1; $i <= $request->player; $i++) {
                # code...
                $data['order'] = 1;
                $data['player'] = $i;
                $data['dice'] = rand(1,6);

                $this->repo->create($data);
            }
        }

        return redirect()->route('dice.play')->with('success', 'First roll has been success');

    }

    public function createPlayer($request)
    {
        # code...
        for ($i=1; $i <= $request->player; $i++) {
            # code...
            $player['id'] = $i;
            $player['amount_dice'] = $request->dice;
            $player['count_down'] = $request->dice - 1;
            $player['has_dice'] = $request->dice;

            $this->repoPlayer->create($player);
        }

        return true;
    }

    public function count($id)
    {
        # code...
        $dices = Dice::where('order', $id)->get();
        $lastPlayer = Player::all()->last()->id;
        foreach ($dices as $value) {
            # code...
            $idPlayer = $value->player;
            switch ($value->dice) {
                case 1:
                    # code...
                    if ($value->id == $lastPlayer) {
                        # code...
                        $sittingNext = 1;
                        $data['player'] = $sittingNext;
                    } else {
                        # code...
                        $sittingNext = $value->player +1;
                        $data['player'] = $sittingNext;
                    }
                    Dice::find($value->id)->update($data);
                    $id1 = Player::find($idPlayer);
                    $id1->update([
                        'has_dice' => $id1->has_dice -1,
                    ]);
                    $id2 = Player::find($sittingNext);
                    $id2->update([
                        'has_dice' => $id2->has_dice +1,
                    ]);

                    break;

                case 6:
                    # code...
                    $id2 = Player::find($idPlayer);
                    $id2->update([
                        'has_dice' => $id2->has_dice -1,
                        'points' => $value->players->points +1
                    ]);
                    $this->repo->delete($value->id);
                    break;

                default:
                    # code...
                    break;
            }
        }
        return redirect()->back()->with('success', 'Scoring has been success');

    }

    public function roll()
    {
        # code...
        $players = Player::with('dices')->get();
        foreach ($players as $value) {
            # code...
            $dices = Dice::where('player', $value->id)->get();
            $dataPlayer['count_down'] = $value->count_down - 1;
            $this->repoPlayer->update($dataPlayer, $value->id);
            for ($i=0; $i < $value->has_dice; $i++) {
                # code...
                $data['order'] = $dices->last()->order+1;
                $data['player'] = $value->id;
                $data['dice'] = rand(1,6);

                $this->repo->create($data);
            }
        }

        return redirect()->route('dice.play')->with('success', 'Next roll has been success');

    }

    public function reset()
    {
        # code...
        Player::truncate();
        Dice::truncate();
        return redirect()->route('dice.index')->with('success', 'Reset has been success');
    }

}
