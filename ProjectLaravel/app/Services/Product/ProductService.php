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
  public function getAllProductSearchByType($idType)
  {
    return $this->repository->getAllProductSearchByType($idType);
  }
  public function getAllProductByType($idType)
  {
    return $this->repository->getAllProductByType($idType);
  }
}
