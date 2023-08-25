<?php

namespace App\Repositories\OrderDetail;

use App\Repositories\BaseRepositoryInterface;

interface OrderDetailRepositoryInterface extends BaseRepositoryInterface
{
  public function findByProductId($idProduct);
  public function updateByProductId($idProduct, $data);
  public function getListByUserId($userId, $status);
  public function findCustomJoinByOrderId($orderId);
  public function findAllByOrderId($orderId);
}
