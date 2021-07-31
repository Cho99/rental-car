<?php

namespace App\Repositories\User;

use App\Models\User;
use Auth;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getOrderByUserId($userId)
    {
        $user = $this->model->find($userId);

        return $user->load(['orders' => function($query) {
            return $query->whereIn('status', [config('define.order.status.pending'), config('define.order.status.accept'), config('define.order.status.borrowed')]);
        }]);
    }


    public function getRequestOrderPending()
    {
        return $this->model->with(['cars.orders.user','cars.orders'])->where('id', Auth::id())->first();
    }

    public function getUserHaveRoleAdmins($roles)
    {
        return $this->model->where('role_id', $roles)->get();
    }
}
