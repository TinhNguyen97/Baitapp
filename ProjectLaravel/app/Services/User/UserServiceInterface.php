<?php

namespace App\Services\User;

use App\Services\BaseServiceInterface;

interface UserServiceInterface extends BaseServiceInterface
{
  public function updateTokenByEmail($email, $data);
  public function findByEmail($email);
  public function getAllPaginate($page);
  public function searchByNameOrEmail($key);
}