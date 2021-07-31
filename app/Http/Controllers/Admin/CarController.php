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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = $this->carRepo->findOrFail($id);

        return view('admin.car.show', compact('car'));
    }

    public function listRegister()
    {
        $cars = Car::where('status', config('define.car.status.pending'))->get();

        return view('admin.car.list_register', compact('cars'));
    }

    public function listBlock()
    {
        $cars = Car::where('status', config('define.car.status.block'))->get();

        return view('admin.car.list_block', compact('cars'));
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
            $this->carRepo->update($car->id, [
                'status' => config('define.car.status.accept'),
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
            $this->carRepo->update($car->id, [
                'status' => config('define.car.status.reject'),
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
            $this->carRepo->update($car->id, [
                'status' => config('define.car.status.block'),
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
            $this->carRepo->update($car->id, [
                'status' => config('define.car.status.accept'),
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
