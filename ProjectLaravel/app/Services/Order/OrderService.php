<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;
use App\Services\BaseService;

class OrderService extends BaseService implements OrderServiceInterface
{
  protected $repository;
  public function __construct(OrderRepository $orderRepository)
  {
    $this->repository = $orderRepository;
  }
}
