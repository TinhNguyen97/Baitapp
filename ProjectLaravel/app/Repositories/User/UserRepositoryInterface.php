<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
  public function updateTokenByEmail($email, $data);
  public function findByEmail($email);
  public function getAllPaginate($page);
  public function searchByNameOrEmail($key);
}
