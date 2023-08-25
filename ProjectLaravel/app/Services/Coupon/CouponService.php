<?php

namespace App\Services\Coupon;

use App\Repositories\Coupon\CouponRepository;
use App\Services\BaseService;
use App\Services\Coupon\CouponServiceInterface;
use Illuminate\Http\Request;

class CouponService extends BaseService implements CouponServiceInterface
{
  protected $repository;
  public function __construct(CouponRepository $couponRepository)
  {
    $this->repository = $couponRepository;
  }
  public function findAllByStatus($status)
  {
    return $this->repository->findAllByStatus($status);
  }
  public function findAllSearch(Request $request, $status)
  {
    return $this->repository->findAllSearch($request, $status);
  }
  public function findAllSearchPaginate(Request $request, $status)
  {
    return $this->repository->findAllSearchPaginate($request, $status);
  }
  public function updateByCode($code, $data)
  {
    return $this->repository->updateByCode($code, $data);
  }
  public function findByCode($code)
  {
    return $this->repository->findByCode($code);
  }
  public function deleteByCode($code)
  {
    return $this->repository->deleteByCode($code);
  }
}
