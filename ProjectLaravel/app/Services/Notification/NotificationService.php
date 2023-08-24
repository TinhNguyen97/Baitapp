<?php

namespace App\Services\Notification;

use App\Repositories\Notification\NotificationRepository;
use App\Services\BaseService;

class NotificationService extends BaseService implements NotificationServiceInterface
{
  protected $repository;
  public function __construct(NotificationRepository $notificationRepository)
  {
    $this->repository = $notificationRepository;
  }
}
