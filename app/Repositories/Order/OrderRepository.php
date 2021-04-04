<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function where($carId) 
    {
        return $this->model->where('car_id', $carId)->where('status', 0)->first();
    }
}
