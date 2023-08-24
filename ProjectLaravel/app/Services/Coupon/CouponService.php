<?php

namespace App\Services\Coupon;

use App\Repositories\Coupon\CouponRepository;
use App\Services\BaseService;
use App\Services\Coupon\CouponServiceInterface;

class CouponService extends BaseService implements CouponServiceInterface
{
  protected $repository;
  public function __construct(CouponRepository $couponRepository)
  {
    $this->repository = $couponRepository;
  }
}
