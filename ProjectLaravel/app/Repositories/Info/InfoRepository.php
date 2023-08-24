<?php

namespace App\Repositories\Info;

use App\Models\Infors;
use App\Repositories\BaseRepository;

class InfoRepository extends BaseRepository implements InfoRepositoryInterface
{
  public function __construct(Infors $info)
  {
    $this->model = $info;
  }
}
