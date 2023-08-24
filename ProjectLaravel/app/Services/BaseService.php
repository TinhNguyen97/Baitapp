<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class BaseService implements BaseServiceInterface
{
  protected $repository;
  public function __construct(BaseRepository $repository)
  {
    $this->repository = $repository;
  }
  public function all()
  {
    return $this->repository->all();
  }
  public function find($id)
  {
    return $this->repository->find($id);
  }
  public function create(array $data)
  {
    return $this->repository->create($data);
  }
  public function update(array $data, int $id)
  {
    $object = $this->repository->find($id);
    return $object->update($data);
  }
  public function delete($id)
  {
    $object = $this->repository->find($id);
    return $object->delete();
  }
}
