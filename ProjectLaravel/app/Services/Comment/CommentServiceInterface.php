<?php

namespace App\Services\Comment;

use App\Services\BaseServiceInterface;

interface CommentServiceInterface extends BaseServiceInterface
{
  public function getAllByProductId($productId);
}
