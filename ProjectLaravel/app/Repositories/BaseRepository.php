<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
  protected $model;
  public function __construct(Model $model)
  {
    $this->model = $model;
  }
  public function all()
  {
    return $this->model->all();
  }
  public function find($id)
  {
    return $this->model->find($id);
  }
  public function create(array $data)
  {
    return $this->model->create($data);
  }
  public function update(array $data, int $id)
  {
    $object = $this->model->find($id);
    return $object->update($data);
  }
  public function delete($id)
  {
    $object = $this->model->find($id);
    return $object->delete();
  }
}
