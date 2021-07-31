@extends('layouts.client.layout')

@section('content')
    <section class="parallax-window" data-parallax="scroll"
        data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Danh sách yêu cầu thuê xe</h1>
            </div>
        </div>
    </section>


    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a>
                    </li>
                    <li><a href="#">Yêu cầu</a>
                    </li>
                    <li>Danh sách yêu cầu thêu xe</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Danh sách yêu câu thuê xe</strong></h3>
                        </div>
                        <div class="panel-body">
                            @if ($user->orders->isEmpty())
                                <span>
                                    <h3 class="no-data">Chưa có yêu cầu nào</h3>
                                </span>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Xe</th>
                                                <th>Giá</th>
                                                <th>Số ngày đi</th>
                                                <th style="width:150px;">Ngày đi</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Chủ Xe</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $i = 1;
                                        @endphp
                                        <tbody>
                                            @forelse ($user->orders as $order)
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
                                                    <td class="my_order_price">
                                                        {{ currency_format($totalPrice) }} VNĐ
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
                                                        <span>{{ $order->car->user->name }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($order->status === config('define.order.status.pending') || $order->status === config('define.order.status.reject') || $order->status === config('define.order.status.cancel'))
                                                            <span class="label label-danger"
                                                                style="width:60px;  word-break: break-all;  white-space: revert;">Khi
                                                                nào chủ
                                                                xe xác nhận sẽ xuất
                                                                hiện số điện thoại</span>
                                                        @else
                                                            <span
                                                                class="label label-info">{{ $order->car->user->phone }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @switch($order->status)
                                                            @case(config('define.order.status.pending'))
                                                                <span class="label label-warning">Đang chờ xác nhận</span>
                                                            @break
                                                            @case(config('define.order.status.reject'))
                                                                <span class="label label-danger">Yêu cầu bị từ chối</span>
                                                            @break
                                                            @case(config('define.order.status.accept'))
                                                                <span class="label label-success">Đã chấp thuận</span>
                                                            @break
                                                            @case(config('define.order.status.borrowed'))
                                                                <span class="label label-success">Bạn đã nhận xe</span>
                                                            @break
                                                            @case(config('define.order.status.close'))
                                                                <span class="label label-info">Hoàn thành</span>
                                                            @break
                                                            @case(config('define.order.status.cancel'))
                                                                <span class="label label-danger">Bị Hủy</span>
                                                            @break
                                                            @default
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('my_orders.show', $order->id) }}"
                                                                class="btn btn-info"
                                                                style="margin-right: 5px; margin-bottom: 15px">Chi
                                                                tiết</a>
                                                            @if ($order->status === config('define.order.status.pending') || $order->status === config('define.order.status.accept'))
                                                                <a href="{{ route('my_orders.cancel', $order->id) }}"
                                                                    class="btn btn-danger mb-2">Hủy đơn</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
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
