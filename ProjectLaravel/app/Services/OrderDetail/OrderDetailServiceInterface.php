<?php

namespace App\Services\OrderDetail;

use App\Services\BaseServiceInterface;

interface OrderDetailServiceInterface extends BaseServiceInterface
{
  public function findByProductId($idProduct);
  public function updateByProductId($idProduct, $data);
  public function getListByUserId($userId);
}
