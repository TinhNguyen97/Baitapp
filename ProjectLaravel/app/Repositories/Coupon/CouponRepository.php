<?php

namespace App\Repositories\Coupon;

use App\Models\Coupon;
use App\Repositories\BaseRepository;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
  public function __construct(Coupon $coupon)
  {
    $this->model = $coupon;
  }
}
