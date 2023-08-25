<?php

namespace App\Services\TypeProduct;

use App\Repositories\TypeProduct\TypeProductRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class TypeProductService extends BaseService implements TypeProductServiceInterface
{
  protected $repository;
  public function __construct(TypeProductRepository $typeProductRepository)
  {
    $this->repository = $typeProductRepository;
  }
  public function getAllPaginate()
  {
    return $this->repository->getAllPaginate();
  }
  public function allSearch(Request $request)
  {
    return $this->repository->allSearch($request);
  }
  public function getAllByName($name)
  {
    return $this->repository->getAllByName($name);
  }
}
