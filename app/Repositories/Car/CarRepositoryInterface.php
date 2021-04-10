<?php
namespace App\Repositories\Car;

use App\Repositories\RepositoryInterface;

interface CarRepositoryInterface extends RepositoryInterface
{
   public function getCarRegister();

   public function getCarDiscount();

   public function getAllCar();

   public function getNumberCar();

   public function getUserByCarId($carId);

   public function getCars();
}
