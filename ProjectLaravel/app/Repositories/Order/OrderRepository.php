<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
  public function __construct(Order $order)
  {
    $this->model = $order;
  }
  public function findAllOrderByStatus($status)
  {
    $orders = $this->model
      ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
      ->where('orders.order_status_id', $status)
      ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
      ->latest()
      ->paginate(5);
    return $orders;
  }
  public function search(Request $request)
  {
    $allOrders = $this->model
      ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
      ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
      ->where('orders.order_status_id', '=', 1)
      ->where(function ($query) use ($request) {
        $query->where('email', 'like', '%' . $request->key . '%');
        $query->orWhere('phone', 'like', '%' . $request->key . '%');
      })
      ->latest()
      ->paginate(5);
    return $allOrders;
  }
  public function searchWithKeyAndStatus(Request $request, $status)
  {
    $allOrders = $this->model
      ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
      ->where('orders.order_status_id', '=', $status)
      ->where(function ($query) use ($request) {
        $query->where('email', 'like', '%' . $request->key . '%');
        $query->orWhere('phone', 'like', '%' . $request->key . '%');
      })
      ->latest()
      ->paginate(5);
    return $allOrders;
  }
}
