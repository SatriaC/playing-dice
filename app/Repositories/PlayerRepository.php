<?php

namespace App\Repositories;

use App\Models\Player;
use App\Repositories\BaseRepository;

class PlayerRepository extends BaseRepository
{
    public function __construct(Player $model)
    {
        $this->model = $model;
    }
}
