<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Exception;
use App\Jobs\OrderJob;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Http\Requests\CarStepTwoRequest;
use Illuminate\Support\Facades\Session;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Feature\FeatureRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Address\AddressRepository;
use App\Http\Requests\CreateFinalRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegisterCarNotification;
use App\Events\RegisterCarEvent;

class CarController extends Controller
{
    protected $featureRepo;
    protected $categoryRepo;
    protected $carRepo;
    protected $imageRepo;
    protected $orderRepo;
    protected $userRepo;
    protected $addressRepo;

    public function __construct(
        FeatureRepositoryInterface $featureRepo,
        CategoryRepositoryInterface $categoryRepo,
        CarRepositoryInterface $carRepo,
        ImageRepositoryInterface $imageRepo,
        OrderRepositoryInterface $orderRepo,
        UserRepositoryInterface $userRepo,
        AddressRepository $addressRepo
    ) {
        $this->middleware('auth')->except('index', 'show', 'getVehicle');
        $this->featureRepo = $featureRepo;
        $this->categoryRepo = $categoryRepo;
        $this->carRepo = $carRepo;
        $this->imageRepo = $imageRepo;
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
        $this->addressRepo = $addressRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = $this->carRepo->getCarByUserId(Auth::id());
 
        return view('client.car.index', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->only(['price', 'car_id' ,'discount', 'borrowed_date', 'return_date']);
            $input['user_id'] = Auth::id();
            $carOfUser = $this->carRepo->getUserByCarId($input['car_id']);
            $email = $carOfUser->user->email;
            $input['name'] = Auth::user()->name; 
            $input['name_car'] = $carOfUser->category->name;
            $input['year_of_product'] = $carOfUser->year_of_product;
            $input['user'] = $carOfUser->user;
            $input['phone'] = Auth::user()->phone;

            $user = $this->userRepo->getOrderByUserId(Auth::id(), $input['car_id']);

            if (!$user->orders->isEmpty()) {
                Session::flash('error', 'Bạn chỉ được yêu câu thuê xe một lần');

                return redirect()->back();
            }

            $this->orderRepo->create($input) ? 
                Session::flash('success', 'Bạn đã yêu cầu đặt xe thành công, vui lòng đợi chủ xe liên lạc với bạn'):
                Session::flash('error', 'Hệ thống lỗi');
 
            OrderJob::dispatch($email, $input);
            DB::commit();
            return redirect()->back();
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();

            return redirect()->back();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = $this->carRepo->getCarByCarId($id);

        return view('client.car.book', compact('car'));
    }

    public function stepOne()
    {
        $features = $this->featureRepo->get();
        $categories = $this->categoryRepo->getTrademark('id');
        $addresses = $this->addressRepo->getListAddress();

        return view('client.car.create_step_1', compact('features', 'categories', 'addresses'));
    }

    public function createStepOne(CarRequest $request)
    {
        $sessionCar = Session::get('car');

        if (empty($sessionCar) || $sessionCar['step1']['license_plates'] == $request->license_plates) {
            $step1 = [
                'step1' => [
                    'license_plates' => $request->license_plates,
                    'trademark' => $request->trademark,
                    'vehicle' => $request->vehicle,
                    'seats' => $request->seats,
                    'year_of_product' => $request->year_of_product,
                    'actions' => $request->actions,
                    'type_of_fuel' => $request->type_of_fuel,
                    'fuel_consumption' => $request->fuel_consumption,
                    'feature' => $request->feature,
                ],
            ];
            Session::put('car', $step1);
        } else {
            Session::forget('car');
            $step1 = [
                'step1' => [
                    'license_plates' => $request->license_plates,
                    'trademark' => $request->trademark,
                    'vehicle' => $request->vehicle,
                    'seats' => $request->seats,
                    'year_of_product' => $request->year_of_product,
                    'actions' => $request->actions,
                    'type_of_fuel' => $request->type_of_fuel,
                    'fuel_consumption' => $request->fuel_consumption,
                    'feature' => $request->feature,
                ],
            ];
            Session::put('car', $step1);
        }
        $carNumber = $request->license_plates;

        return view('client.car.create_step_2', compact('carNumber'));
    }
    
    public function createStepTwoView() 
    {
        $car = Session::get('car');
        $carNumber = $car['step1']['license_plates'];

        return view('client.car.create_step_2', compact('carNumber'));
    }

    public function createStepThreeView() 
    {
        $car = Session::get('car');
        $carNumber = $car['step1']['license_plates'];

        return view('client.car.create_step_3', compact('carNumber'));
    }

    public function createStepTwo(CarStepTwoRequest $request)
    {
        $sessionCar = Session::get('car');

        if (!$sessionCar['step1']) {
            return redirect()->route('create-step-one');
        }


        if ($sessionCar) {
            $sessionCar['step2'] = [
                'price' => $request->price,
                'discount' => $request->discount,
                'limited_km' => $request->limited_km,
                'limit_pass_fee' => $request->limit_pass_fee,
                'description' => $request->description,
            ];
            Session::put('car', $sessionCar);
        }
        $carNumber = $sessionCar['step1']['license_plates'];

        return view('client.car.create_step_3', compact('carNumber'));
    }

    public function createFinal(CreateFinalRequest $request)
    {
        $sessionCar = Session::get('car');
        $dataImage = [];

        if (!$sessionCar['step2']) {
            return redirect()->route('create-step-two');
        }

        if ($sessionCar) {
            $car = $this->carRepo->create([
                'user_id' => Auth::id(),
                'license_plates' => $sessionCar['step1']['license_plates'],
                'seats' => $sessionCar['step1']['seats'],
                'type_of_fuel' => $sessionCar['step1']['type_of_fuel'],
                'actions' => $sessionCar['step1']['actions'],
                'type_of_fuel' => $sessionCar['step1']['type_of_fuel'],
                'year_of_product' => '2021-4-3',
                'category_id' => $sessionCar['step1']['vehicle'],
                'price' => $sessionCar['step2']['price'],
                'discount' => $sessionCar['step2']['discount'],
                'limited_km' => $sessionCar['step2']['limited_km'],
                'limit_pass_fee' => $sessionCar['step2']['limit_pass_fee'],
                'description' => $sessionCar['step2']['description'],
                'address_id' => 1,
                'fuel_consumption' => 100,
            ]);
            $this->carRepo->attach($car, 'features', $sessionCar['step1']['feature']);

            foreach ($request->images as $image) {
                $image->move('upload/car', $image->getClientOriginalName());
                $nameImage = $image->getClientOriginalName();
                array_push($dataImage, $nameImage);
            }

            $this->imageRepo->create([
                'car_id' => $car->id,
                'image_list' => json_encode($dataImage),
            ]);

            $users = $this->userRepo->getUserHaveRoleAdmins(0);
            $userId = $users->pluck('id');
         
            $data = [
                'users' => $userId,
                'user_name' => Auth::user()->name,
                'request_id' => $car->id,
                'content' => 'Đăng ký xe',
                'license_plates' =>  $car->license_plates,
            ];

            Auth::user()->notify(new RegisterCarNotification($data));
            event(new RegisterCarEvent($data));
        
            return redirect()->route('cars.index');
        }

    }

    public function getVehicle($id)
    {
        $model = $this->categoryRepo->findOrFail($id);
        $categories = $this->categoryRepo->load($model, 'children');
        $data = [];

        foreach ($categories->children as $child) {
            array_push($data, ['id' => $child->id, 'name' => $child->name]);
        }

        return response()->json($data);
    }
}
