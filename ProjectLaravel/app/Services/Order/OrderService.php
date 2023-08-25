<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class OrderService extends BaseService implements OrderServiceInterface
{
  protected $repository;
  public function __construct(OrderRepository $orderRepository)
  {
    $this->repository = $orderRepository;
  }
  public function findAllOrderByStatus($status)
  {
    return $this->repository->findAllOrderByStatus($status);
  }
  public function search(Request $request)
  {
    return $this->repository->search($request);
  }
  public function searchWithKeyAndStatus(Request $request, $status)
  {
    return $this->repository->searchWithKeyAndStatus($request, $status);
  }
}
