<?php

namespace App\Repositories\TypeProduct;

use App\Models\TypeProduct;
use App\Repositories\BaseRepository;

class TypeProductRepository extends BaseRepository implements TypeProductRepositoryInterface
{
  public function __construct(TypeProduct $typeProduct)
  {
    $this->model = $typeProduct;
  }
}
