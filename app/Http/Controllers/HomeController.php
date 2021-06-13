<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Models\Comment;
use App\Models\Report;
use App\Http\Requests\ReportRequest;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carDiscounts = $this->carRepo->getCarDiscount();
        $cars = $this->carRepo->getAllCar();

        $numberCar = $this->carRepo->getNumberCar();
        $addresses = $this->addressRepo->getHotDistrict();

        return view('client.index', compact('cars', 'carDiscounts', 'numberCar', 'addresses'));
    }

    public function getCars(Request $request)
    {
        $dataSearch = $request->only([
            'address'
        ]);

        $cars = $this->carRepo->getCars($dataSearch);
   
        return view('client.car.list_car', compact('cars'));
    }

    public function review(Request $request)
    {
        $request['user_id'] = Auth::id();
        $request['rate'] = $request->input('rate');
        if ($request->comment === null) {
            $request['comment'] = 'Không bình luận';
        }
        
        $result = Comment::create($request->all());
        $date = Carbon::parse($result->created_at)->format('m/d/Y');
        if ($result) {
            $data = [
                'name' => $result->user->name,
                'vote' => $result->rate,
                'created_at' => $date,
                'comment' => $result->comment,
            ];

            return response()->json([
                'data' => $data,
            ]);
        }

        return response()->json(false);
    }

    public function reports(ReportRequest $request)
    {
        $result = Report::create([
            'user_id' => Auth::id(),
            'car_id' => $request->input('car_id'),
            'description' => $request->input('description'),
            'status' => Report::UNREAD,
        ]);

        return response()->json([
            'success' => $result,
        ]);
    }
}
