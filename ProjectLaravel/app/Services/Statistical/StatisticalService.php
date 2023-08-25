<?php

namespace App\Services\Statistical;

use App\Repositories\Statistical\StatisticalRepository;
use App\Services\BaseService;

class StatisticalService extends BaseService implements StatisticalServiceInterface
{
  protected $repository;
  public function __construct(StatisticalRepository $statisticalRepository)
  {
    $this->repository = $statisticalRepository;
  }
  public function findByMonthYear($monthYear)
  {
    return $this->repository->findByMonthYear($monthYear);
  }
}
