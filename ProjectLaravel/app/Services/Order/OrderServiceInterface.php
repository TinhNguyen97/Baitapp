<?php

namespace App\Services\Order;

use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

interface OrderServiceInterface extends BaseServiceInterface
{
  public function findAllOrderByStatus($status);
  public function search(Request $request);
  public function searchWithKeyAndStatus(Request $request, $status);
}
