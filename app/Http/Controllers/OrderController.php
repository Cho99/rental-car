<?php

namespace App\Http\Controllers;

use Exception;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Jobs\AcceptJob;
use App\Jobs\CloseJob;
use App\Jobs\CancelJob;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Car\CarRepositoryInterface;

class OrderController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->userRepo->getRequestOrderPending();
        
        return view('client.order.index', compact('user'));
    }

    public function accept($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepo->findOrFail($id);
        
            if ($order->status === config('define.order.status.pending')) {
                $this->orderRepo->update($id, [
                    'status' => config('define.order.status.accept'),
                ]);
    
                $this->carRepo->update($order->car->id, [
                    'status' => config('define.car.status.renting'),
                ]);

                $orderRelate = Order::where('car_id', $order->car_id)
                    ->where('status', config('define.order.status.pending'))
                    ->where('id', '<>', '$order->id')->get();
                foreach ($orderRelate as $item) {
                    $this->orderRepo->update($item->id, [
                        'status' => config('define.order.status.reject'),
                    ]);
                }

                $data = [
                    'user' => $order->user->name,
                    'owner' => Auth::user()->name,
                    'phone' => Auth::user()->phone,
                    'order_id' => $order->id,
                ];

                AcceptJob::dispatch($order->user->email, $data);

                DB::commit();
                
                return redirect()->route('orders.show', $id);
            }
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function reject($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepo->findOrFail($id);

            if ($order->status === config('define.order.status.pending')) {
                $this->orderRepo->update($id, [
                    'status' => config('define.order.status.reject'),
                ]);
    
                DB::commit();

                return redirect()->route('orders.show', $id)->with('success', 'Từ chối đơn thành công');
            }
        } catch (\Throwable $th) {
            report($ex);
            DB::rollBack();

            return redirect()->back();
        }
       
        return redirect()->back();
    }

    public function borrowed($id)
    {
        $order = $this->orderRepo->findOrFail($id);

        if ($order->status === config('define.order.status.accept')) {
            $result = $this->orderRepo->update($id, [
                'status' => config('define.order.status.borrowed'),
            ]);

            if ($result) {
                return redirect()->route('orders.show', $id)->with('success', 'Người thuê đã nhận xe thành công');
            }
        }

        return redirect()->back();
    }

    public function close($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepo->findOrFail($id);

            if ($order->status === config('define.order.status.borrowed')) {
                $this->orderRepo->update($id, [
                    'status' => config('define.order.status.close'),
                ]);

                $this->carRepo->update($order->car->id, [
                    'status' => config('define.car.status.accept'),
                ]);
                $data = [
                    'user' => $order->user->name,
                    'owner' => Auth::user()->name,
                    'phone' => Auth::user()->phone,
                    'order_id' => $order->id,
                ];
                CloseJob::dispatch($order->user->email, $data);
                DB::commit();
                
                return redirect()->route('orders.show', $id);
            }
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepo->findOrFail($id);

            if ($order->status === config('define.order.status.borrowed') || $order->status === config('define.order.status.accept')) {
                $this->orderRepo->update($id, [
                    'status' => config('define.order.status.cancel'),
                ]);
    
                $this->carRepo->update($order->car->id, [
                    'status' => config('define.car.status.accept'),
                ]);
                $data = [
                    'user' => $order->user->name,
                    'owner' => Auth::user()->name,
                    'phone' => Auth::user()->phone,
                    'order_id' => $order->id,
                ];
                CancelJob::dispatch($order->user->email, $data);
                DB::commit();
                
                return redirect()->route('orders.show', $id);
            }
        } catch (\Throwable $th) {
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
        $order = $this->orderRepo->findOrFail($id);

        return view('client.order.show', compact('order'));
    }
}
