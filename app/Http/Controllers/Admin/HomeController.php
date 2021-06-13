<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->middleware('auth')->only('review');
        $this->carRepo = $carRepo;
        $this->addressRepo = $addressRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    
    public function chart()
    {
        $carRegister = $this->carRepo->getCarRegisterChart();
        $data = [];
        $list = [];
        foreach ($carRegister as $car) {
            array_push($data, $car);
        }
        
        foreach ($data as $item) {
            $val = [
                'month' => $item->month,
                'car' => $item->car,
            ];
            array_push($list, $val);
        }

        return response()->json([
            'list' => $list,
        ]);
    }
}
