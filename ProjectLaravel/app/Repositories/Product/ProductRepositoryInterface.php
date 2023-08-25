<?php

namespace App\Repositories\Product;

use App\Models\Products;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
  public function getNewProducts();
  public function topSaleProducts();
  public function getAllProductSearch(Request $request);
  public function getAllProductWithKeys(Request $request);
  public function getAllProductSearchByType($idType, $status);
  public function getAllProductByType($idType, $status);
  public function getAllProductAndType();
  public function searchByNameOrPrice(Request $request);
  public function getAllSearch(Request $request);
  public function getAllByTypeId($typeId);
  public function getAllRelativeProducts($typeId);
}
