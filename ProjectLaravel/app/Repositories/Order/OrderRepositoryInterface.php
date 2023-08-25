<?php

namespace App\Repositories\Order;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
  public function findAllOrderByStatus($status);
  public function search(Request $request);
  public function searchWithKeyAndStatus(Request $request, $status);
}
