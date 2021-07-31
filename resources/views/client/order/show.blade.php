@extends('layouts.client.layout')

@section('content')
    <section class="parallax-window" data-parallax="scroll"
        data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Mã đơn: {{ $order->id }}</h1>
            </div>
        </div>
    </section>
    <main>
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
                                    <img src="{{ asset('bower_components/car-client-lte/' . '/img/avatar3.jpg') }}" alt=""
                                        class="img-circle">
                                @endif
                            </div>
                            <div class="col-md-9 col-sm-9">
                                @if ($order->status === config('define.order.status.pending'))
                                    <label>Họ và tên: {{ $order->user->name }}</label>
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
                                    <label>Ngày sinh:</label>
                                    {{ Carbon\Carbon::parse($order->user->date_of_birth)->format('d-m-Y') }}
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
                                $totalPrice = (($order->price * (100 - $order->discount)) / 100) * $totalDate;
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
                                    @if ($totalPrice)
                                        <td>
                                            <span>{{ currency_format($totalPrice) }}VNĐ</span>
                                        </td>
                                    @else
                                        <td>
                                            {{ currency_format($order->price) }}VNĐ
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
                                        {{ currency_format($totalPrice) }}VNĐ
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($order->car->status === config('define.car.status.block') && $order->status === config('define.order.status.pending'))
                            <h2>Xe đã bị ngưng hoạt động</h2>
                        @elseif ($order->car->status === config('define.car.status.renting') && $order->status ===
                            config('define.order.status.pending'))
                            <h2>Xe đang được thuê</h2>
                        @elseif ($order->car->status === config('define.car.status.accept') || $order->car->status ===
                            config('define.car.status.renting'))
                            @if ($order->status === config('define.order.status.accept'))
                                <h4 style="text-align: center"><span class="label label-success">Đơn đã được chấp
                                        thuận</span></h4>
                                <span style="text-align: center">
                                    <a style="text-align: center" class="btn_full"
                                        href="{{ route('orders.borrowed', $order->id) }}">Người thuê đã nhận xe</a>
                                </span>
                                <span style="text-align: center">
                                    <a style="text-align: center" class="btn_full_outline btn-danger"
                                        href="{{ route('orders.cancel', $order->id) }}">Hủy đơn</a>
                                </span>
                            @elseif ($order->status === config('define.order.status.reject'))
                                <h4 style="text-align: center"><span class="label label-danger">Đơn đã bị từ chối</span>
                                </h4>
                            @elseif ($order->status === config('define.order.status.borrowed'))
                                <div style="text-align: center">
                                    <a style="text-align: center" class="btn_full"
                                        href="{{ route('orders.close', $order->id) }}">Kết thúc đơn</a>
                                </div>
                                <span style="text-align: center">
                                    <a style="text-align: center" class="btn_full_outline btn-danger"
                                        href="{{ route('orders.cancel', $order->id) }}">Hủy đơn</a>
                                </span>
                            @elseif ($order->status === config('define.order.status.cancel'))
                                <h4 style="text-align: center"><span class="label label-danger">Đơn đã bị hủy</span></h4>
                            @elseif ($order->status === config('define.order.status.close'))
                                <h4 style="text-align: center"><span class="label label-info">Đơn đã hoàn thành</span></h4>
                            @elseif ($order->status === config('define.order.status.pending'))
                                <a class="btn_full" href="{{ route('orders.accept', $order->id) }}">Chấp thuận</a>
                                <a class="btn_full_outline btn-danger"
                                    href="{{ route('orders.reject', $order->id) }}"></i>Từ chối</a>
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
                                            <td class="text-center"><strong>Thông tin xe</strong></td>
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
                                            <td class="image-car-info">
                                                @php
                                                    $images = null;
                                                    if (!empty($order->car->image)) {
                                                        $images = json_decode($order->car->image->image_list);
                                                    }
                                                @endphp
                                                <div class="image-car">
                                                    @if (isset($images))
                                                        <div class="sp-slide">
                                                            <img src="{{ asset('upload/car') . '/' . $images[0] }}"
                                                                alt="" width="150px">
                                                        </div>
                                                    @else
                                                        <div class="sp-slide">
                                                            <img alt="Image" class="sp-image"
                                                                src="{{ asset('bower_components/car-client-lte') }}/css/images/blank.gif"
                                                                data-src="{{ asset('images/car.jpg') }}" width="150px">
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <label for="">{{ $order->car->category->name }} -
                                                            {{ Carbon\Carbon::parse($order->car->year_of_product)->year }}</label>
                                                        <p><strong>Biển số xe: {{ $order->car->license_plates }}</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($order->discount)
                                                    <span>{{ currency_format($totalPrice) }}</span>VNĐ
                                                @else
                                                    <span>{{ currency_format($order->price) }}</span>VNĐ
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
