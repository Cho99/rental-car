@extends('layouts.client.layout')

@section('content')
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Order Request</h1>
            <p>Danh sách yêu cầu thuê xe</p>
        </div>
    </div>
</section>


<main>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#">Home</a>
                </li>
                <li><a href="#">Orders</a>
                </li>
                <li>Manager Order</li>
            </ul>
        </div>
    </div>
    <!-- End Position -->

    <div class="container margin_60">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Danh sách yêu cầu thuê xe</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Car</th>
                                        <th>Price</th>
                                        <th>Số ngày đi</th>
                                        <th>Ngày đi</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Người thuê</th>
                                        <th>Số điện thoại</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->cars as $car)
                                    @foreach ($car->orders as $order)
                                    @php
                                        $borrowedDate = Carbon\Carbon::parse($order->borrowed_date);
                                        $returnDate = Carbon\Carbon::parse($order->return_date);
                                        $totalDate = $returnDate->diffInDays($borrowedDate);
                                        $totalPrice = ($order->price * (100 - $order->discount) / 100) * $totalDate;
                                    @endphp
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <div>
                                                <strong>{{ $order->car->category->name }} - {{ Carbon\Carbon::parse($order->car->year_of_product)->year }}</strong>
                                                <p>
                                                    <strong>Biển số xe: {{ $order->car->license_plates }}</strong> 
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $totalPrice }} K
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
                                                <span class="label label-danger">Khi nào xác nhận sẽ xuất hiện số điện thoại người thuê</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Chi tiết</a>
                                            <a href="{{ route('orders.accept', $order->id) }}" class="btn btn-success">Xác nhận</a>
                                            <a href="{{ route('orders.reject', $order->id) }}" class="btn btn-danger">Từ chối</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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