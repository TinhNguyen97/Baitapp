<?php

namespace App\Services\TypeProduct;

use App\Repositories\TypeProduct\TypeProductRepository;
use App\Services\BaseService;

class TypeProductService extends BaseService implements TypeProductServiceInterface
{
  protected $repository;
  public function __construct(TypeProductRepository $typeProductRepository)
  {
    $this->repository = $typeProductRepository;
  }
}
