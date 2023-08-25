<?php

namespace App\Services\Coupon;

use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

interface CouponServiceInterface extends BaseServiceInterface
{
  public function findAllByStatus($status);
  public function findAllSearch(Request $request, $status);
  public function findAllSearchPaginate(Request $request, $status);
  public function updateByCode($code, $data);
  public function findByCode($code);
  public function deleteByCode($code);
}
