<?php

namespace App\Services\TypeProduct;

use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

interface TypeProductServiceInterface extends BaseServiceInterface
{
  public function getAllPaginate();
  public function allSearch(Request $request);
  public function getAllByName($name);
}
