@extends('layouts.client.layout')
@section('css')

@endsection
@section('content')
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
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
                                <img src="{{ asset('bower_components/car-client-lte/' . '/img/avatar3.jpg') }}" alt="" class="img-circle">
                            @endif 
                        </div>
                        <div class="col-md-9 col-sm-9">
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
                                        <span>{{ currency_format($totalPrice) }}VNĐ</span> 
                                    </td>
                                @else 
                                    <td>
                                        {{ currency_format($order->price) }} VNĐ
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
                                    {{  currency_format($totalPrice *  $totalDate) }}VNĐ
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
                            <a href="{{ route('my_orders.cancel', $order->id) }}"  class="btn_full_outline btn-danger">Hủy đơn</a>
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
                                                <div style="text-decoration: line-through;">{{ currency_format($order->price) }}VNĐ</div> 
                                                <span>{{    ($totalPrice) }}</span>VNĐ
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
            @if ($order->status === config('define.order.status.close'))
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Bình luận</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 comment">
                                @if (!$order->car->comments->isEmpty())
                                    @foreach ($order->car->comments as $comment)
                                        <div class="review_strip_single">
                                            <small> - {{ \Carbon\Carbon::parse($comment->created_at)->format('m/d/Y') }} -</small>
                                            <label>{{ $comment->user->name }}</label>
                                            <div class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i < $comment->rate)
                                                        <i class="icon-smile voted"></i>
                                                    @else
                                                        <i class="icon-smile"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p>
                                               {{ $comment->comment }}
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <label class="no-comment">Chưa có bình luận nào</label>
                                    <br>
                                    <br>
                                @endif
                            </div>
                            <form class="review">
                                <input type="hidden" name="car_id" value="{{ $order->car_id }}">
                                <label>Đánh giá</label>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" checked />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                 <div class="form-group">
                                    <label for="comment">Bình luận</label>
                                    <textarea name="comment" id="review_text" class="form-control" style="height:100px" placeholder="Hay viết bình luận"></textarea>
                                </div>
                                <button class="btn_full">Bình luận</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
