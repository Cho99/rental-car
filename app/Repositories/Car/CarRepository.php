<?php

namespace App\Repositories\Car;

use App\Models\Car;
use App\Repositories\BaseRepository;

class CarRepository extends BaseRepository implements CarRepositoryInterface
{
    public function getModel()
    {
        return Car::class;
    }

    public function getCarRegister()
    {
        $this->model->where('status', 0)->get();
    }
}
