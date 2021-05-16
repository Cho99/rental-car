<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DB;
use Auth;
use App\Jobs\Client\CancelJob;
use App\Models\User;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Car\CarRepositoryInterface;

class ClientController extends Controller
{
    protected $orderRepo;

    protected $userRepo;

    protected $carRepo;

    public function __construct(
        OrderRepositoryInterface $orderRepo, 
        UserRepositoryInterface $userRepo,
        CarRepositoryInterface $carRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
        $this->carRepo = $carRepo;
    }

    public function getOrderRequest()
    {
        $user = User::with('orders.car.user')->where('id', Auth::id())->first();

        return view('client.my_request.index', compact('user'));
    }

    public function show($id) 
    {
        $order = $this->orderRepo->getOrderByIdWithComment($id);
      
        return view('client.my_request.show', compact('order'));
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepo->findOrFail($id);
            if ($order->status === config('define.order.status.pending')) {
                $this->orderRepo->update($id, [
                    'status' => config('define.order.status.cancel'),
                ]);
    
                $this->carRepo->update($order->car->id, [
                    'status' => config('define.car.status.accept'),
                ]);
                $data = [
                    'user' => $order->car->user->name,
                    'customer' => Auth::user()->name,
                    'order_id' => $order->id,
                ];

                CancelJob::dispatch($order->car->user->email, $data);
                DB::commit();
                
                return redirect()->route('orders.show', $id);
            }
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();

            return redirect()->back();
        }
    }
}
