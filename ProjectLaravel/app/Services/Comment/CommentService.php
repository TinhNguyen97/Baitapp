<?php

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use App\Services\BaseService;

class CommentService extends BaseService implements CommentServiceInterface
{
  protected $repository;
  public function __construct(CommentRepository $commentRepository)
  {
    $this->repository = $commentRepository;
  }
  public function getAllByProductId($productId)
  {
    return $this->repository->getAllByProductId($productId);
  }
}
