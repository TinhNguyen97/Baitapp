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
  public function getAllProductSearchByType($idType, $status)
  {
    $allProductSearchByType = $this->model->where('is_active', $status)->where('type_id', $idType)->paginate(8);
    return $allProductSearchByType;
  }
  public function getAllProductByType($idType, $status)
  {
    $allProductByType = $this->model->where('is_active',  $status)->where('type_id', $idType)->get();
    return $allProductByType;
  }
  public function getAllProductAndType()
  {
    $allProducts = $this->model
      ->join('type_products', 'products.type_id', '=', 'type_products.id')
      ->select('products.*', 'type_products.name as tp_name', 'type_products.id as type_id')
      ->latest()
      ->paginate(5);
    return $allProducts;
  }
  public function searchByNameOrPrice(Request $request)
  {
    $allProducts = $this->model->where('name', 'like', '%' . $request->key . '%')
      ->orWhere('unit_price', $request->key)
      ->orWhere('promotion_price', $request->key)->latest()->get();
    return $allProducts;
  }
  public function getAllSearch(Request $request)
  {
    $allProductSearch = $this->model
      ->join('type_products', 'products.type_id', '=', 'type_products.id')
      ->select('products.*', 'type_products.name as tp_name', 'type_products.id as type_id')
      ->where('products.name', 'like', '%' . $request->key . '%')
      ->orWhere('products.unit_price',   $request->key)
      ->orWhere('products.promotion_price',  $request->key)
      ->latest()
      ->paginate(5);
    return $allProductSearch;
  }
  public function getAllByTypeId($typeId)
  {
    $allproducts = $this->model->where('type_id', $typeId)->get();
    return $allproducts;
  }
  public function getAllRelativeProducts($typeId)
  {
    $allRelativeProducts = $this->model->where('type_id', $typeId);

    return $allRelativeProducts;
  }
}
