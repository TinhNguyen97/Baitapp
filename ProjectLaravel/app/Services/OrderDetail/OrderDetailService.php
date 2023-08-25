<?php

namespace App\Services\OrderDetail;

use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Services\BaseService;

class OrderDetailService extends BaseService implements OrderDetailServiceInterface
{
  protected $repository;
  public function __construct(OrderDetailRepository $orderDetailRepository)
  {
    $this->repository = $orderDetailRepository;
  }
  public function findByProductId($idProduct)
  {
    return $this->repository->findByProductId($idProduct);
  }
  public function updateByProductId($idProduct, $data)
  {
    return $this->repository->updateByProductId($idProduct, $data);
  }
  public function getListByUserId($userId, $status)
  {
    return $this->repository->getListByUserId($userId, $status);
  }
  public function findCustomJoinByOrderId($orderId)
  {
    return $this->repository->findCustomJoinByOrderId($orderId);
  }
  public function findAllByOrderId($orderId)
  {
    return $this->repository->findAllByOrderId($orderId);
  }
}
