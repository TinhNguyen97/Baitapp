<?php

namespace App\Services\Info;

use App\Repositories\Info\InfoRepository;
use App\Services\BaseService;

class InfoService extends BaseService implements InfoServiceInterface
{
  protected $repository;
  public function __construct(InfoRepository $infoRepository)
  {
    $this->repository = $infoRepository;
  }
}
