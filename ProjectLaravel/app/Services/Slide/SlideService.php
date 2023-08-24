<?php

namespace App\Services\Slide;

use App\Repositories\Slide\SlideRepository;
use App\Services\BaseService;
use App\Services\Slide\SlideServiceInterface;

class SlideService extends BaseService implements SlideServiceInterface
{
  protected $repository;
  public function __construct(SlideRepository $slideRepository)
  {
    $this->repository = $slideRepository;
  }
}
