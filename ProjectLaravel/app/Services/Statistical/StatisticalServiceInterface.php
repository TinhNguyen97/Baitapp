<?php

namespace App\Services\Statistical;

use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

interface StatisticalServiceInterface extends BaseServiceInterface
{
  public function findByMonthYear($monthYear);
}
