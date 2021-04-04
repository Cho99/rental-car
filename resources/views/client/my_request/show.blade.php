@extends('layouts.client.layout')

@section('content')
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Order Request</h1>
            <p>Danh sách yêu cầu thuê xe - Đơn: {{ $order->id }}</p>
        </div>
    </div>
</section>
<main style="margin-bottom: 353px;">
    <div class="container margin_60">
        <div class="row">
            <aside class="col-md-4">
                <div class="box_style_1 expose" style="z-index: 4;">
                    <h3 class="inner">Thông tin người thuê xe</h3>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            @if ($order->user->avatar)
                                <img src="" alt="" class="img-circle">
                            @else 
                                <img src="{{ asset('bower_components/car-client-lte/' . '/img/avatar3.jpg') }}" alt="" class="img-circle">
                            @endif 
                        </div>
                        <div class="col-md-9 col-sm-9">
                            @if ($order->status === config('define.order.status.pending'))
                                <label>{{ $order->user->name }}</label>
                                <div>
                                    <label>Hãy chấp thuận để có thể thấy thông tin liên lạc với người thuê</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label>{{ $order->user->name }}</label>
                                    <div class="order-user--info">
                                        <label>Số điện thoại: </label> 
                                        <span class="label label-info">{{ $order->user->phone }}</span>                                     
                                    </div>
                                    <div>
                                        <label>Email: </label>
                                        <span>{{ $order->user->email }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12  col-sm-12">
                            @if ($order->user->date_of_birth)
                                <label>Ngày sinh:</label> {{ Carbon\Carbon::parse($order->user->date_of_birth)->format('d-m-Y') }}
                            @else
                                <Label>Ngày sinh:</Label><span>Chưa xác nhận</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12  col-sm-12">
                            @if ($order->user->sex === 1)
                                <label>Giới tính:</label><span>Nam</span>
                            @elseif ($order->user->sex === 2)
                                <Label>Giới tính:</Label><span>Nữ</span>
                            @else
                                <Label>Giới tính:</Label><span>Chưa xác nhận</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Bằng lái xe:</label>
                                @if ($order->user->gplx)
                                    <span>Đã xác nhận</span>
                                @else
                                    <span>Chưa xác nhận</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h3 style="text-align: center;">Thông tin thuê xe</h3>
                    <table class="table table_summary">
                        @php
                            $borrowedDate = Carbon\Carbon::parse($order->borrowed_date);
                            $returnDate = Carbon\Carbon::parse($order->return_date);
                            $totalDate = $returnDate->diffInDays($borrowedDate);
                            $totalPrice = ($order->price * (100 - $order->discount) / 100) * $totalDate;
                        @endphp
                        <tbody>
                            <tr>
                                <td>
                                    Ngày bắt đầu
                                </td>
                                <td class="text-right">
                                    {{ Carbon\Carbon::parse($order->borrowed_date)->format('d-m-Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ngày kết thúc
                                </td>
                                <td class="text-right">
                                    {{ Carbon\Carbon::parse($order->return_date)->format('d-m-Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng số ngày thuê
                                </td>
                                <td class="text-right">
                                    {{ $totalDate }} Ngày
                                </td>
                            </tr>
                            <tr>
                                <td>Số tiền thuê xe</td>
                                @if ($order->discount)
                                    <td>
                                        <span>{{ number_format($totalPrice, 0, '', ',') }} K</span> 
                                    </td>
                                @else 
                                    <td>
                                        {{ $order->price }} K
                                    </td>
                                @endif 
                            </tr>
                            <tr>
                                <td>Giảm giá</td>
                                <td>
                                    {{ $order->discount }} %
                                </td>
                            </tr>
                            <tr class="total">
                                <td>
                                    Tổng tiền
                                </td>
                                <td class="text-right">
                                    {{  $totalPrice *  $totalDate}}K
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($order->car->status === config('define.car.status.block') && $order->status ===  config('define.order.status.pending'))
                       <h2>Xe đã bị ngưng hoạt động</h2> 
                    @elseif ($order->car->status ===  config('define.car.status.renting') && $order->status === config('define.order.status.pending')) 
                        <h2>Xe đang được thuê</h2> 
                    @elseif ($order->car->status ===  config('define.car.status.accept') || $order->car->status ===  config('define.car.status.renting'))
                        @if ($order->status === config('define.order.status.accept'))
                            <h4  style="text-align: center"><span class="label label-success">Đơn đã được chấp thuận</span></h4>
                        @elseif ($order->status === config('define.order.status.reject'))
                            <h4 style="text-align: center"><span class="label label-danger">Đơn đã bị từ chối</span></h4> 
                        @elseif ($order->status === config('define.order.status.borrowed'))
                        <h4 style="text-align: center"><span class="label label-danger">Bạn đã nhận xe</span></h4>
                        @elseif ($order->status === config('define.order.status.cancel'))
                            <h4 style="text-align: center"><span class="label label-danger">Đơn đã bị hủy</span></h4>
                        @elseif ($order->status === config('define.order.status.close'))
                            <h4 style="text-align: center"><span class="label label-info">Đơn đã hoàn thành</span></h4>  
                        @elseif ($order->status === config('define.order.status.pending'))
                            <a href="{{ route('my_orders.cancel', $order->id) }}" class="btn btn-danger">Hủy đơn</a>
                        @endif
                    @endif
                </div>
            </aside>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Thông tin xe</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>ID</strong></td>
                                        <td class="text-center"><strong>Xe</strong></td>
                                        <td class="text-center"><strong>Giá tiền</strong></td>
                                        <td class="text-center"><strong>Giảm giá</strong></td>
                                        <td class="text-center"><strong>Nhiên liệu</strong></td>
                                        <td class="text-center"><strong>Truyền động</strong></td>
                                        <td class="text-right"><strong>Trạng thái</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <tr>
                                        <td>{{ $order->car->id }}</td>
                                        <td class="text-center">
                                            <div>
                                                <img src="{{ asset('upload/car/') }}" alt="">
                                                <div>
                                                    <label for="">{{ $order->car->category->name }} - {{ Carbon\Carbon::parse($order->car->year_of_product)->year }}</label>
                                                    <p><strong>Biển số xe: {{ $order->car->license_plates }}</strong></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($order->discount)
                                                <div style="text-decoration: line-through;">{{ $order->price }}K</div> 
                                                <span>{{ $totalPrice }}</span>K
                                            @else 
                                                <span>{{ $order->price }}</span>K
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($order->discount)
                                                {{ $order->discount }} %
                                            @else
                                                0 %
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($order->car->type_of_fuel === 1)
                                                Xăng
                                            @else
                                                Dầu
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($order->car->actions === 1)
                                                Số sàn
                                            @else
                                                Số tự động
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @switch($order->car->status)
                                                @case(config('define.car.status.accept'))
                                                    <span>Đang chờ được thuê</span>
                                                    @break
                                                 @case(config('define.car.status.renting'))
                                                    <span>Xe đang được thuê</span>
                                                    @break
                                                @case(config('define.car.status.block'))
                                                    <span>Xe đã bị ngưng hoạt động</span>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection