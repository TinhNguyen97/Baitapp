<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
  public function __construct(Comment $comment)
  {
    $this->model = $comment;
  }
  public function getAllByProductId($productId)
  {
    $comments = $this->model->where('product_id', $productId)
      ->join('users', 'comments.user_id', '=', 'users.id')
      ->get();
    return $comments;
  }
}
