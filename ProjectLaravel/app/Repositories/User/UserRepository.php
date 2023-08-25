<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  public function __construct(User $user)
  {
    $this->model = $user;
  }
  public function updateTokenByEmail($email, $data)
  {
    $user = $this->model->where('email', $email)->first();
    $user->update($data);
  }
  public function findByEmail($email)
  {
    $user = $this->model->where('email', $email)->first();
    return $user;
  }
  public function getAllPaginate($page)
  {
    $users = $this->model->paginate($page);
    return $users;
  }
  public function searchByNameOrEmail($key)
  {
    $users = $this->model
      ->where('full_name', 'like', '%' . $key . '%')
      ->orWhere('email', 'like', '%' . $key . '%')
      ->paginate();
    return $users;
  }
}
