<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ProductService extends BaseService implements ProductServiceInterface
{
  protected $repository;
  public function __construct(ProductRepository $productRepository)
  {
    $this->repository = $productRepository;
  }
  public function getNewProducts()
  {
    return $this->repository->getNewProducts();
  }
  public function topSaleProducts()
  {
    return $this->repository->topSaleProducts();
  }
  public function getAllProductSearch(Request $request)
  {
    return $this->repository->getAllProductSearch($request);
  }
  public function getAllProductWithKeys(Request $request)
  {
    return $this->repository->getAllProductWithKeys($request);
  }
  public function getAllProductSearchByType($idType, $status)
  {
    return $this->repository->getAllProductSearchByType($idType, $status);
  }
  public function getAllProductByType($idType, $status)
  {
    return $this->repository->getAllProductByType($idType, $status);
  }
  public function getAllProductAndType()
  {
    return $this->repository->getAllProductAndType();
  }
  public function searchByNameOrPrice(Request $request)
  {
    return $this->repository->searchByNameOrPrice($request);
  }
  public function getAllSearch(Request $request)
  {
    return $this->repository->getAllSearch($request);
  }
  public function getAllByTypeId($typeId)
  {
    return $this->repository->getAllByTypeId($typeId);
  }
  public function getAllRelativeProducts($typeId)
  {
    return $this->repository->getAllRelativeProducts($typeId);
  }
}
