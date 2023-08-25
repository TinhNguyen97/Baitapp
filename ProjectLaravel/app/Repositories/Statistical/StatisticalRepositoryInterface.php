<?php

namespace App\Repositories\Statistical;

use App\Repositories\BaseRepositoryInterface;

interface StatisticalRepositoryInterface extends BaseRepositoryInterface
{
  public function findByMonthYear($monthYear);
}
