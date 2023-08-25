<?php

namespace App\Repositories\Coupon;

use App\Models\Coupon;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
  public function __construct(Coupon $coupon)
  {
    $this->model = $coupon;
  }
  public function findAllByStatus($status)
  {
    $allCoupons = $this->model->where('is_active', $status)->latest()
      ->paginate(5);
    return $allCoupons;
  }
  public function findAllSearch(Request $request, $status)
  {
    $coupons = $this->model->where('is_active', $status)
      ->where(function ($query) use ($request) {
        $query->where('coupon_name', 'like', '%' . $request->key . '%');
        $query->orwhere('code', 'like', '%' . $request->key . '%');
      })->get();
    return $coupons;
  }
  public function findAllSearchPaginate(Request $request, $status)
  {
    $allCouponSearch = $this->model
      ->where('is_active', $status)
      ->where(function ($query) use ($request) {
        $query->where('coupon_name', 'like', '%' . $request->key . '%');
        $query->orwhere('code', 'like', '%' . $request->key . '%');
      })
      ->latest()
      ->paginate(5);
    return $allCouponSearch;
  }
  public function updateByCode($code, $data)
  {
    $this->model->where('code', $code)->update($data);
  }
  public function findByCode($code)
  {
    $cou = $this->model->where('code', $code)->first();
    return $cou;
  }
  public function deleteByCode($code)
  {
    $this->model->where('code', $code)->delete();
  }
}
