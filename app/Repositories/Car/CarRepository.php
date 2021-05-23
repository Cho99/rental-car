<?php

namespace App\Repositories\Car;

use App\Models\Car;
use DB;
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
       $model = $this->model
        ->with('image')
        ->withCount('comments')
        ->where('discount', '<>' ,null)
        ->where('status', config('define.car.status.accept'))
        ->orderBy('discount', 'DESC')
        ->limit(6)
        ->get();

       return $model->load('image');
    }

    public function getAllCar()
    {
        return $model = $this->model
            ->with('image')
            ->withCount('comments')
            ->where('discount', '<>' ,null)
            ->where('status', config('define.car.status.accept'))
            ->orderBy('discount', 'DESC')
            ->limit(6)
            ->get();
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
    
    public function getCars()
    {
        return $this->model
        ->withCount('comments')
        ->with('image', 'comments')
        ->where('status', config('define.car.status.accept'))
        ->orderBy('discount', 'DESC')
        ->paginate(6);
    }

    public function getCarRegisterChart()
    {
        return DB::table('cars')
            ->select(DB::raw('month(created_at) as month'), DB::raw('count(cars.id) as car'))
            ->where('cars.status', config('define.car.status.reject'))
            ->groupBy(DB::raw('month(cars.created_at)'))
            ->get();
    }

    public function getCarByUserId($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->withCount('comments')
            ->with('comments', 'features', 'image')
            ->paginate(6);
    }

    public function getCarByCarId($carId)
    {
        return $this->model
        ->withCount('comments')
        ->with('comments', 'features', 'image', 'user')
        ->findOrFail($carId);
    }
}
