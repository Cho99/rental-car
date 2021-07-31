@extends('layouts.client.layout')

@section('content')
    <section class="parallax-window" data-parallax="scroll"
        data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Danh sách cho thuê xe</h1>
            </div>
        </div>
    </section>


    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li><a href="#">Yêu cầu cho thuê xe</a>
                    </li>
                    <li>Danh sách quản lý yêu cầu cho thuê xe</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Danh sách yêu cầu cho thuê xe</strong></h3>
                        </div>
                        <div class="panel-body">
                            @if ($user->cars->isEmpty())
                                <span>
                                    <h3 class="no-data">Chưa có xe nào được thuê</h3>
                                </span>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Thông tin xe</th>
                                                <th>Giá tiền</th>
                                                <th>Số ngày đi</th>
                                                <th style="width: 100px">Ngày đi</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Người thuê</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($user->cars as $car)
                                                @foreach ($car->orders->reverse()->values() as $order)
                                                    @php
                                                        $borrowedDate = Carbon\Carbon::parse($order->borrowed_date);
                                                        $returnDate = Carbon\Carbon::parse($order->return_date);
                                                        $totalDate = $returnDate->diffInDays($borrowedDate);
                                                        $totalPrice = (($order->price * (100 - $order->discount)) / 100) * $totalDate;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            <div>
                                                                <strong>{{ $order->car->category->name }} -
                                                                    {{ Carbon\Carbon::parse($order->car->year_of_product)->year }}</strong>
                                                                <p>
                                                                    <strong>Biển số xe:
                                                                        {{ $order->car->license_plates }}</strong>
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ currency_format($totalPrice) }}VNĐ
                                                        </td>
                                                        <td>
                                                            <span>{{ $totalDate }} ngày</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ Carbon\Carbon::parse($order->borrowed_date)->format('d-m-Y') }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ Carbon\Carbon::parse($order->return_date)->format('d-m-Y') }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $order->user->name }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($order->status === 0)
                                                                <span class="label label-danger"
                                                                    style="width:40px; white-space: revert;">Khi
                                                                    nào xác nhận sẽ xuất
                                                                    hiện số điện thoại người thuê</span>
                                                            @else
                                                                <span
                                                                    class="label label-info">{{ $order->user->phone }}</span>
                                                            @endif
                                                        </td>
                                                        </td>
                                                        <td>
                                                            @if ($order->car->status === config('define.car.status.block') && $order->status === config('define.order.status.pending'))
                                                                <span><span class="label label-danger">Xe đã bị ngưng hoạt
                                                                        động<span class="label label-success"></h2>
                                                                        @elseif (
                                                                            $order->status ===
                                                                            config('define.order.status.pending'))
                                                                            <span><span class="label label-success">Đang chờ
                                                                                    xác nhận</span>
                                                                            @elseif ($order->car->status ===
                                                                                config('define.car.status.accept') ||
                                                                                $order->car->status ===
                                                                                config('define.car.status.renting'))
                                                                                @if ($order->status === config('define.order.status.accept'))
                                                                                    <span style="text-align: center"><span
                                                                                            class="label label-success">Đơn
                                                                                            đã được chấp thuận</span></span>
                                                                                @elseif ($order->status ===
                                                                                    config('define.order.status.reject'))
                                                                                    <span style="text-align: center"><span
                                                                                            class="label label-danger">Đơn
                                                                                            đã bị từ chối</span></span>
                                                                                @elseif ($order->status ===
                                                                                    config('define.order.status.borrowed'))
                                                                                    <span style="text-align: center"><span
                                                                                            class="label label-info">Người
                                                                                            thuê đã nhận được
                                                                                            xe</span></span>
                                                                                @elseif ($order->status ===
                                                                                    config('define.order.status.cancel'))
                                                                                    <span style="text-align: center"><span
                                                                                            class="label label-danger">Đơn
                                                                                            đã bị hủy</span></span>
                                                                                @elseif ($order->status ===
                                                                                    config('define.order.status.close'))
                                                                                    <span style="text-align: center"><span
                                                                                            class="label label-success">Đơn
                                                                                            đã hoàn thành</span></span>
                                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($order->car->status !== config('define.car.status.block'))
                                                                @if ($order->status === 0)
                                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                                        class="btn btn-info"
                                                                        style="margin-bottom: 10px">Chi tiết</a>
                                                                    <a href="{{ route('orders.accept', $order->id) }}"
                                                                        class="btn btn-success"
                                                                        style="margin-bottom: 10px">Xác nhận</a>
                                                                    <a href="{{ route('orders.reject', $order->id) }}"
                                                                        class="btn btn-danger"
                                                                        style="margin-bottom: 10px">Từ chối</a>
                                                                @else
                                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                                        class="btn btn-info"
                                                                        style="margin-bottom: 10px">Chi tiết</a>
                                                                @endif
                                                            @else
                                                                <h4><span class="label label-danger">Xe đã bị ngưng hoạt
                                                                        động</span></h4>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- End section -->
            </div>
        </div>
        <!--End container -->

        <div id="overlay"></div>
        <!-- Mask on input focus -->

    </main>
@endsection
