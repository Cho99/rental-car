<?php

namespace App\Repositories\Order;

use DB;
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

    public function getOrderByIdWithComment($id)
    {
        return $this->model->with(['car', 'car.comments' => function($query) {
            return $query->orderBy('comments.id', 'desc');
        }])->findOrFail($id);
    }

    public function getCarOrderSuccess() 
    {
        return DB::table('orders')
            ->select(DB::raw('month(created_at) as month'), DB::raw('count(orders.id) as car'))
            ->whereIn('status', [config('define.order.status.accept'), config('define.order.status.close')])
            ->groupBy(DB::raw('month(orders.created_at)'))
            ->get();
    }
}
