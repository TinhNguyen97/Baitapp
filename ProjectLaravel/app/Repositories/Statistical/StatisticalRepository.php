<?php

namespace App\Repositories\Statistical;

use App\Models\Statistical;
use App\Repositories\BaseRepository;

class StatisticalRepository extends BaseRepository implements StatisticalRepositoryInterface
{
  public function __construct(Statistical $statistical)
  {
    $this->model = $statistical;
  }
  public function findByMonthYear($monthYear)
  {
    $statistical = $this->model->where('month_year', 'like', '%' . $monthYear . '%')->first();
    return $statistical;
  }
}
