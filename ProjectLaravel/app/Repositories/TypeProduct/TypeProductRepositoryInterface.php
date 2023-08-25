<?php

namespace App\Repositories\TypeProduct;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface TypeProductRepositoryInterface extends BaseRepositoryInterface
{
  public function getAllPaginate();
  public function allSearch(Request $request);
  public function getAllByName($name);
}
