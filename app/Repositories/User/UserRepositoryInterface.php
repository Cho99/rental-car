<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getOrderByUserId($userId, $carId);

    public function getRequestOrderPending();
}
