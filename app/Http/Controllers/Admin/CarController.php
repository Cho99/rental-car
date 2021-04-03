<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Repositories\Car\CarRepositoryInterface;
use Exception;

class CarController extends Controller
{
    protected $carRepo;

    public function __construct(CarRepositoryInterface $carRepo)
    {
        $this->carRepo = $carRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::whereNotIn('status', [0, 1])->get();

        return view('admin.car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $car = $this->carRepo->findOrFail($id);

        if($car->status === 0 || $car->status === 1) {
            return redirect()->back();
        }
        
        return view('admin.car.show', compact('car'));
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

    public function listRegister()
    {
        $cars = Car::where('status', 0)->get();

        return view('admin.car.list_register', compact('cars'));
    }

    public function register($id)
    {
        $car = $this->carRepo->findOrFail($id);

        if($car->status !== 0 && $car->status !== 1) {
            return redirect()->back();
        }
        
        return view('admin.car.register', compact('car'));
    }

    public function accept(Request $request)
    {
        try {
            $car = $this->carRepo->findOrFail($request->input('id'));
            $result = $this->carRepo->update($request->id, [
                'status' => 2,
            ]);
    
            return response()->json([
                'message' => 'success',
            ]);
        } catch (Exception $ex) {
            report($ex);

            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    public function reject(Request $request)
    {
        try {
            $car = $this->carRepo->findOrFail($request->input('id'));
            $result = $this->carRepo->update($request->id, [
                'status' => 1,
            ]);
    
            return response()->json([
                'message' => 'success',
            ]);
        } catch (Exception $ex) {
            report($ex);

            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    public function block(Request $request)
    {
        try {
            $car = $this->carRepo->findOrFail($request->input('id'));
            $result = $this->carRepo->update($request->id, [
                'status' => 4,
            ]);
    
            return response()->json([
                'message' => 'success',
            ]);
        } catch (Exception $ex) {
            report($ex);

            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    public function unblock(Request $request)
    {
        try {
            $car = $this->carRepo->findOrFail($request->input('id'));
            $result = $this->carRepo->update($request->id, [
                'status' => 2,
            ]);
    
            return response()->json([
                'message' => 'success',
            ]);
        } catch (Exception $ex) {
            report($ex);

            return response()->json([
                'message' => 'error',
            ]);
        }
    }
}
