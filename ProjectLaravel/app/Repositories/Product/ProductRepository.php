<?php

namespace App\Repositories\Product;

use App\Models\Products;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
  public function __construct(Products $products)
  {
    $this->model = $products;
  }
  public function getNewProducts()
  {
    $newProducts = $this->model->orderByRaw('created_at DESC')->where('is_active', 1)->limit(4)->get();
    return $newProducts;
  }
  public function topSaleProducts()
  {
    $topSaleProducts = $this->model
      ->join('order_details', 'products.id', '=', 'order_details.product_id')
      ->join('orders', 'order_details.order_id', '=', 'orders.id')
      ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
      ->where('orders.order_status_id', 2)
      ->where('is_active', 1)
      ->groupBy('products.name')
      ->orderByRaw('count(products.name) DESC')
      ->orderByRaw('products.name')
      ->limit(8)
      ->get('products.*');
    return $topSaleProducts;
  }
  public function getAllProductSearch(Request $request)
  {
    $allProductSearch = $this->model
      ->where('is_active', 1)
      ->where(function ($query) use ($request) {
        $query->where('products.name', 'like', '%' . $request->key . '%');
        $query->orWhere('products.unit_price', $request->key);
        $query->orWhere('products.promotion_price',  $request->key);
      })
      ->latest()
      ->paginate(8);
    return $allProductSearch;
  }
  public function getAllProductWithKeys(Request $request)
  {
    $allProductWithKeys = $this->model
      ->where('is_active', 1)
      ->where(function ($query) use ($request) {
        $query->where('products.name', 'like', '%' . $request->key . '%');
        $query->orWhere('products.unit_price', $request->key);
        $query->orWhere('products.promotion_price',  $request->key);
      })
      ->latest()
      ->paginate(8);
    return $allProductWithKeys;
  }
  public function getAllProductSearchByType($idType)
  {
    $allProductSearchByType = $this->model->where('is_active', 1)->where('type_id', $idType)->paginate(8);
    return $allProductSearchByType;
  }
  public function getAllProductByType($idType)
  {
    $allProductByType = $this->model->where('is_active', 1)->where('type_id', $idType)->get();
    return $allProductByType;
  }
}
