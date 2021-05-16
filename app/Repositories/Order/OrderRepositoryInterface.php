<?php
namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
   public function where($carId);

   public function getOrderByIdWithComment($id);
}
