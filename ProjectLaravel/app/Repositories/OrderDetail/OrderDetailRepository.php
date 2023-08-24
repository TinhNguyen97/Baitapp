<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
  public function __construct(OrderDetail $orderDetail)
  {
    $this->model = $orderDetail;
  }
  public function findByProductId($idProduct)
  {
    $product = $this->model->where('product_id', $idProduct)->first();
    return $product;
  }
  public function updateByProductId($idProduct, $data)
  {
    $this->model->where('product_id', $idProduct)->update($data);
  }
  public function getListByUserId($userId)
  {
    $list = $this->model
      ->join('orders', 'order_details.order_id', '=', 'orders.id')
      ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
      ->join('products', 'order_details.product_id', '=', 'products.id')
      ->join('coupons', 'orders.coupon_id', 'coupons.id')
      ->where('order_details.user_id', $userId)
      ->where('order_statuses.id', 2)
      ->selectRaw('*, order_details.quantity AS sq')
      ->orderBy('products.name')
      ->get();
    return $list;
  }
}
