<?php

namespace App\Repositories\Coupon;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface CouponRepositoryInterface extends BaseRepositoryInterface
{
  public function findAllByStatus($status);
  public function findAllSearch(Request $request, $status);
  public function findAllSearchPaginate(Request $request, $status);
  public function updateByCode($code, $data);
  public function findByCode($code);
  public function deleteByCode($code);
}
