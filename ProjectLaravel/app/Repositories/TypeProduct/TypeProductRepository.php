<?php

namespace App\Repositories\TypeProduct;

use App\Models\TypeProduct;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class TypeProductRepository extends BaseRepository implements TypeProductRepositoryInterface
{
  public function __construct(TypeProduct $typeProduct)
  {
    $this->model = $typeProduct;
  }
  public function getAllPaginate()
  {
    $allTypes = $this->model->latest()->paginate(5);
    return $allTypes;
  }
  public function allSearch(Request $request)
  {
    $allTypes = TypeProduct::where('name', 'like', '%' . $request->key . '%')->latest()->get();
    return $allTypes;
  }
  public function getAllByName($name)
  {
    $allTypeSearch = $this->model
      ->where('type_products.name', 'like', '%' . $name . '%')
      ->latest()
      ->paginate(5);
    return $allTypeSearch;
  }
}
