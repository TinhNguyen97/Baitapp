<?php

namespace App\Services\Product;

use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

interface ProductServiceInterface extends BaseServiceInterface
{
  public function getNewProducts();
  public function topSaleProducts();
  public function getAllProductSearch(Request $request);
  public function getAllProductWithKeys(Request $request);
  public function getAllProductSearchByType($idType);
  public function getAllProductByType($idType);
}
