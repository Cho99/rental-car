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
        return $this->model->where('status', 0)->get();
    }

    public function getCarDiscount()
    {
       $model = $this->model->where('discount', '<>' ,null)->orderBy('discount', 'DESC')->limit(6)->get();

       return $model->load('image');
    }

    public function getNumberCar()
    {
        return $this->model->whereIn('status', [2, 3])->count();
    }

    public function getUserByCarId($carId) 
    {
        $car = $this->model->findOrFail($carId);

        return $car->load('user'); 
    }
}
