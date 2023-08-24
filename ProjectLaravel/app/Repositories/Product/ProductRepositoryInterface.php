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
  public function getAllProductSearchByType($idType);
  public function getAllProductByType($idType);
}
