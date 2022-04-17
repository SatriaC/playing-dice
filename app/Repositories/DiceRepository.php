<?php

namespace App\Repositories;

use App\Models\Dice;
use App\Repositories\BaseRepository;

class DiceRepository extends BaseRepository
{
    public function __construct(Dice $model)
    {
        $this->model = $model;
    }
}
