<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;

class HomeController extends Controller
{
    protected $carRepo;

    protected $addressRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $carRepo,
        AddressRepositoryInterface $addressRepo
    ) {
        // $this->middleware('auth');
        $this->carRepo = $carRepo;
        $this->addressRepo = $addressRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carDiscounts = $this->carRepo->getCarDiscount();
        $numberCar = $this->carRepo->getNumberCar();
        $addresses = $this->addressRepo->getHotDistrict();

        return view('client.index', compact('carDiscounts', 'numberCar', 'addresses'));
    }
}
