<?php

namespace App\Repositories\Slide;

use App\Models\Slides;
use App\Repositories\BaseRepository;


class SlideRepository extends BaseRepository implements SlideRepositoryInterface
{
  public function __construct(Slides $slides)
  {
    $this->model = $slides;
  }
}
