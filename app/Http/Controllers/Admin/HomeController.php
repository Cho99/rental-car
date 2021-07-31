<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $carRepo;

    protected $addressRepo;

    protected $orderRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $carRepo,
        AddressRepositoryInterface $addressRepo,
        OrderRepositoryInterface $orderRepo
    ) {
        $this->middleware('auth')->only('review');
        $this->carRepo = $carRepo;
        $this->addressRepo = $addressRepo;
        $this->orderRepo = $orderRepo;
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
        $orderCarSuccess = $this->orderRepo->getCarOrderSuccess();
        $data = [];
        $list = [];
        foreach ($orderCarSuccess as $car) {
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

    public function changeLanguage(Request $request)
    {
        $lang = $request->language;
        if ($lang != 'en' && $lang != 'vi') {
            $lang = config('app.locale');
        }

        Session::put('language', $lang);

        return redirect()->back();
    }
}
