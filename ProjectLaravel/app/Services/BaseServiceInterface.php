<?php

namespace App\Services;

interface BaseServiceInterface
{
  public function all();
  public function find($id);
  public function create(array $data);
  public function update(array $data, int $id);
  public function delete($id);
}
