<?php

namespace App\Http\Controllers;

use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Feature\FeatureRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Session;

class CarController extends Controller
{
    protected $featureRepo;
    protected $categoryRepo;
    protected $carRepo;
    protected $imageRepo;

    public function __construct(
        FeatureRepositoryInterface $featureRepo,
        CategoryRepositoryInterface $categoryRepo,
        CarRepositoryInterface $carRepo,
        ImageRepositoryInterface $imageRepo
    ) {
        $this->featureRepo = $featureRepo;
        $this->categoryRepo = $categoryRepo;
        $this->carRepo = $carRepo;
        $this->imageRepo = $imageRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->load(['cars.category', 'cars.features', 'cars.address', 'cars.image']);

        return view('client.car.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stepOne()
    {
        $features = $this->featureRepo->get();
        $categories = $this->categoryRepo->getTrademark('id');

        return view('client.car.create_step_1', compact('features', 'categories'));
    }

    public function createStepOne(Request $request)
    {
        $sessionCar = Session::get('car');

        if (empty($sessionCar) || $sessionCar['step1']['car_number'] == $request->car_number) {
            $step1 = [
                'step1' => [
                    'car_number' => $request->car_number,
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
                    'car_number' => $request->car_number,
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
        $carNumber = $request->car_number;

        return view('client.car.create_step_2', compact('carNumber'));
    }

    public function createStepTwo(Request $request)
    {
        $sessionCar = Session::get('car');

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
        $carNumber = $sessionCar['step1']['car_number'];

        return view('client.car.create_step_3', compact('carNumber'));
    }

    public function createFinal(Request $request)
    {
        $sessionCar = Session::get('car');
        $dataImage = [];
        if ($sessionCar) {
            $car = $this->carRepo->create([
                'user_id' => Auth::id(),
                'license_plates' => $sessionCar['step1']['car_number'],
                'seats' => $sessionCar['step1']['seats'],
                'type_of_fuel' => $sessionCar['step1']['type_of_fuel'],
                'actions' => $sessionCar['step1']['actions'],
                'type_of_fuel' => $sessionCar['step1']['type_of_fuel'],
                'year_of_product' => '2021-4-3',
                'category_id' => $sessionCar['step1']['vehicle'],
                'price' => $sessionCar['step2']['price'],
                'discount' => $sessionCar['step2']['discount'],
                'limited_km' => $sessionCar['step2']['discount'],
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
