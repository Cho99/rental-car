@extends('layouts.client.layout')

@section('css')
    <link href="{{ asset('bower_components/car-client-lte') }}/css/slider-pro.min.css" rel="stylesheet">
    <link href="{{ asset('bower_components/car-client-lte') }}/css/date_time_picker.css" rel="stylesheet">
@endsection

@section('content')

@php
$images = null;
if (!empty($car->image)) {
    $images = json_decode($car->image->image_list);
}
@endphp

@if (isset($images))
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('upload/car') . '/' . $images[0] }}" data-natural-width="1400" data-natural-height="470" style="object-fit: cover;">
@else
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('images/car.jpg') }}" data-natural-width="1400" data-natural-height="470" style="object-fit: cover;">
@endif
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <h1>{{ $car->category->name }} - {{ date('Y', strtotime($car->year_of_product)) }}</h1>
                    <span>Đánh giá: </span>
                    <span class="rating">
                        <i class="icon-smile"></i>
                        <i class="icon-smile"></i>
                        <i class="icon-smile"></i>
                        <i class="icon-smile"></i>
                        <i class="icon-smile"></i>
                        <small>(0)</small>
                        <span class="bar-line">-------</span>
                        @if ($car->orders->isEmpty())
                            <span>Chưa có chuyến nào</span>
                        @else
                            <span>{{ $car->orders->count() }}</span>
                        @endif
                    </span>
                    <div>
                        @if ($car->actions === 1)
                            <span class="label label-danger">Số tự động</span>
                        @else
                            <span class="label label-warning">Số sàn</span>
                        @endif
                        @if ($car->discount)
                           <span class="label label-info">Giảm giá: {{ $car->discount }} %</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div id="price_single_main">
                        @if ($car->discount)
                            @php    
                                $totalPrice = $car->price*(100-$car->discount)/100;
                            @endphp
                            <sup style="text-decoration: line-through;">{{ $car->price }} K</sup><span>{{ $totalPrice }} K</span> / Ngày
                        @else
                            <span>{{ $car->price }} K</span> / Ngày
                        @endif
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<main style="margin-bottom: 353px;">
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#">Home</a>
                </li>
                <li><a href="#">Car</a>
                </li>
                <li>{{ $car->category->name }}</li>
            </ul>
        </div>
    </div>
    <!-- End Position -->

    <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div>
    <!-- End Map -->

    <div class="container margin_60">
        <div class="row">
            <div class="col-md-8" id="single_tour_desc">

                <div id="single_tour_feat">
                    <ul>
                        @foreach ($car->features as $feature)
                            <li>
                                <img src="{{ asset('upload/feature') . '/' . $feature->image }}" alt="{{ $feature->name }}" title="{{ $feature->name }}" style="width: 36px; height: 36px">
                                <br>
                                {{ $feature->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="visible-sm visible-xs"><a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
                </p>

                <!-- Map button for tablets/mobiles -->

                <div id="Img_carousel" class="slider-pro">
                    @if (isset($images))
                        <div class="sp-slides">
                            @foreach ($images as $image)
                            <div class="sp-slide">
                                <img alt="Image" class="sp-image" src="{{ asset('bower_components/car-client-lte') }}/css/images/blank.gif" data-src="{{ asset('upload/car') . '/' . $image }}">
                            </div>
                            @endforeach
                        </div>
                        @if (count($images) > 4) 
                            <div class="sp-thumbnails">
                                @foreach ($images as $image)
                                    <img alt="Image" class="sp-thumbnail" src="{{ asset('upload/car') . '/' . $image }}">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="sp-slides">
                            <div class="sp-slide">
                                <img alt="Image" class="sp-image" src="{{ asset('bower_components/car-client-lte') }}/css/images/blank.gif" data-src="{{ asset('images/car.jpg') }}">
                            </div>
                        </div> 
                    @endif
                   
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Đặc điểm</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <img src="" alt=""> Số ghế: {{ $car->seats }}
                                </div>
                                <div>
                                    <img src="" alt=""> Nhiên liệu: 
                                    @if ($car->type_of_fuel === 1)
                                        Xăng 
                                    @else
                                        Dầu
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <img src="" alt=""> Truyền động: 
                                    @if ($car->actions === 1)
                                        Số sàn 
                                    @else
                                        Số tự động
                                    @endif
                                </div>
                                <div>
                                    <img src="" alt=""> Mức tiêu thụ nhiên liệu: {{ $car->fuel_consumption }} lít/100km
                                </div>
                            </div>
                        </div>
                        <!-- End row  -->
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Mô tả</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                {{ $car->description }}
                            </div>
                        </div>
                        <!-- End row  -->
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Tính năng</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            @foreach ( $car->features as $feature)
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <img src="" alt=""> {{ $feature->name }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- End row  -->
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Giấy tờ thuê xe (bản gốc)</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <img src="" alt=""> CMND và GPLX (đối chiếu)
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <img src="" alt=""> Hộ Khẩu hoặc KT3 hoặc Passport (giữ lại)
                                </div>
                            </div>
                        </div>
                        <!-- End row  -->
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Tài sản thế chấp</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            15 triệu (tiền mặt/chuyển khoản cho chủ xe khi nhận xe)
                            hoặc Xe máy (kèm cà vẹt gốc) giá trị 15 triệu
                        </div>
                        <!-- End row  -->
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Điều khoản</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <p>
                                1. Chấp nhận Hộ khẩu Thành phố/KT3 Thành phố/Hộ khẩu tỉnh/Passport (Bản gốc) (Giữ lại khi nhận xe)
                                CMND và GPLX đối chiếu
                            </p>
                            <p>
                                2. Tài sản đặt cọc (1 trong 2 hình thức)
                                <p>
                                    <span>
                                        - Xe máy (giá trị >15triệu) + Cà vẹt (bản gốc)
                                    </span>
                                </p>
                                <p>
                                    - Hoặc cọc tiền mặt 15 triệu.
                                </p>
                            </p>
                            <span>
                                * Quý khách lưu ý một số qui định sau:
                                Không sử dụng xe thuê vào mục đích phi pháp, trái pháp luật
                                Không được sử dụng xe thuê để cầm cố hay thế chấp, sử dụng đúng mục đích
                                Không hút thuốc,ăn kẹo cao su xả rác trong xe
                                Không chở hàng quốc cấm dễ cháy nổ,hoa quả thưc phẩm lưu mùi trong xe.
                                Khi trả xe, khách hàng vui lòng vệ sinh sạch sẽ hoặc gửi phụ thu thêm phí rửa xe, hút bụi nếu xe dơ. (sẽ thu nhiều hơn tuỳ theo mức độ dơ) 
                                <p>
                                    Trân trọng cảm ơn, chúc quý khách có những chuyến đi tuyệt vời!
                                </p> 
                            </span>
                            </span>
                        </div>
                        <!-- End row  -->
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Chủ xe</h3>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                {{ $car->user->name }}
                                <p>
                                    <strong>Lưu ý:</strong> Người thuê xe gọi cho bạn nếu họ đồng ý đơn đặt xe của bạn
                                </p>
                            </div>
                        </div>
                        <!-- End row  -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h3>Đánh giá </h3>
                        <p><strong>Chú ý:</strong> Chi khi thuê xe xong bạn mới được đánh giá</p>
                    </div>
                    @if (!$car->comments->isEmpty())
                    <div class="col-md-9">
                        <div id="general_rating">11 Reviews
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
                            </div>
                        </div>
                        <!-- End general_rating -->
                      
                            <div class="row" id="rating_summary">
                                <div class="col-md-6"> 
                                    <ul>
                                        <li>Position
                                            <div class="rating">
                                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
                                            </div>
                                        </li>
                                        <li>Tourist guide
                                            <div class="rating">
                                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li>Price
                                            <div class="rating">
                                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
                                            </div>
                                        </li>
                                        <li>Quality
                                            <div class="rating">
                                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <!-- End row -->
                        <hr>
                        <div class="review_strip_single">
                            @if (!$car->comments->isEmpty())
                                <img src="{{ asset('bower_components/car-client-lte') }}/{{ asset('bower_components/car-client-lte') }}/img/avatar1.jpg" alt="Image" class="img-circle">
                                <small> - 10 March 2015 -</small>
                                <h4>Jhon Doe</h4>
                                <p>
                                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus."
                                </p>
                                <div class="rating">
                                    <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
                                </div>
                            @endif
                        </div>
                        <!-- End review strip -->
                    </div>
                    @endif
                    <span>Chưa có đánh giá nào</span>
                </div>
            </div>
            <!--End  single_tour_desc-->

            <aside class="col-md-4">
                {{-- <p class="hidden-sm hidden-xs">
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
                </p> --}}
                <div class="box_style_1 expose">
                    <h3 class="inner">- Booking -</h3>
                    <form action="{{ route('cars.store') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $car->discount }}" name="discount">
                        <input type="hidden" value="{{ $car->price }}" name="price">
                        <input type="hidden" value="{{ $car->id }}" name="car_id">
                        <div class="row">
                            <h4>Ngày bắt đầu</h4>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Ngày </label>
                                    <input class="form-control" type="date" name="borrowed_date" id="date_start" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->addDays(10)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label><i class=" icon-clock"></i> Giờ </label>
                                    <input class="time-pick form-control" value="12:00 AM" type="text" name="time_start">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Ngày kết thúc</h4>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Ngày </label>
                                    <input class="form-control" type="date" name="return_date" id="date_return" value="{{ \Carbon\Carbon::now()->addDays(1)->format('Y-m-d') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" min="{{ \Carbon\Carbon::now()->addDays(1)->format('Y-m-d') }}" max="{{ \Carbon\Carbon::now()->addDays(11)->format('Y-m-d') }}" >
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label><i class=" icon-clock"></i> Giờ </label>
                                    <input class="time-pick form-control" value="12:00 AM" type="text" name="time_return">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Địa điểm của xe</h4>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Quận: </label>
                                    @if (isset($car->address->parent->name))
                                        <span class="label label-info">{{ $car->address->parent->name }}</span>
                                    @else 
                                        <span class="label label-info">Hà Nội</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Phường: </label>
                                    @if (empty($car->address->name))
                                        <span class="label label-info">{{ $car->address->name }}</span>
                                    @else
                                        <span class="label label-info">Chưa rõ</span>
                                    @endif
                                </div>
                            </div>
                            <span>Điểm điểm cụ thể giao xe sẽ được biết khi được chủ xe liên lạc</span>
                        </div>
                        <div class="row">
                            <h4>Giới hạn km</h4>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <span>Tối đa: </span>
                                    <strong>{{ $car->limited_km }} km.</strong>
                                    <span>Phí: </span>
                                    <strong>{{ $car->limit_pass_fee }}K/km vượt quá giới hạn</strong>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Bảo hiểm</h4>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label><i class="fa icon-shield"></i></label>
                                    <strong>Xe được hỗ trợ bảo hiểm</strong>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Chi tiết giá</h4>
                            <table class="table table_summary">
                                <tbody>
                                    <tr>
                                        <td>
                                            Đơn giá thuê
                                        </td>
                                        @if (isset($totalPrice))
                                            <input type="hidden" value="{{ $totalPrice }}" id="money">
                                        @else
                                            <input type="hidden" value="{{ $car->price }}" id="money">
                                        @endif
    
                                        <td class="text-right">
                                            @if (isset($totalPrice))
                                                {{ $totalPrice }}K / ngày
                                            @else
                                                {{ $car->price }}K / ngày
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tổng phí thuê xe 
                                        </td>
                                        <td class="text-right">
                                            @if (isset($totalPrice))
                                                {{ $totalPrice }}K 
                                            @else
                                                {{ $car->price }}K 
                                            @endif
                                            x 
                                            <strong id="days">1</strong><strong>Ngày</strong>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <td>
                                            Tổng tiền
                                        </td>
                                        <td class="text-right">
                                            <span id="total-money">  
                                                @if (isset($totalPrice))
                                                    {{ $totalPrice }}
                                                @else
                                                    {{ $car->price }}K
                                                @endif
                                            </span> 
                                            <span>VNĐ</span> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @auth
                            @if ($car->user->id !== Auth::id())
                                <button class="btn_full" type="submit">Book now</button>
                            @endif
                        @endauth
                            
                        @guest
                            <button class="btn_full" type="submit">Book now</button>
                        @endguest
                    </form>
                </div>
                <!--/box_style_1 -->

                <div class="box_style_4">
                    <i class="icon_set_1_icon-90"></i>
                    <h4><span>Hỗ trợ</span></h4>
                    <a href="tel://09001000" class="phone">+84 090 010 00</a>
                    <small>Làm việc 8.00am - 4.30pm - <span>Từ thứ 7 đến chủ nhật</span></small>
                </div>

            </aside>
        </div>
        <!--End row -->
    </div>
    <!--End container -->
    
<div id="overlay"></div>
<!-- Mask on input focus -->
    
</main>
@endsection

@section('script')
	<!-- Specific scripts -->
	<script src="{{ asset('bower_components/car-client-lte') }}/js/icheck.js"></script>
	<script>
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-grey',
			radioClass: 'iradio_square-grey'
		});
	</script>
	<!-- Date and time pickers -->
	<script src="{{ asset('bower_components/car-client-lte') }}/js/jquery.sliderPro.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function (e) {
			$('#Img_carousel').sliderPro({
				width: 960,
				height: 500,
				fade: true,
				arrows: true,
				buttons: false,
				fullScreen: false,
				smallSize: 500,
				startSlide: 0,
				mediumSize: 1000,
				largeSize: 3000,
				thumbnailArrows: true,
				autoplay: false
			});
		});
	</script>
     <script src="{{ asset('js/sweetalert.min.js') }}"></script>
	<!-- Date and time pickers -->
	<script src="{{ asset('bower_components/car-client-lte') }}/js/bootstrap-datepicker.js"></script>
	<script src="{{ asset('bower_components/car-client-lte') }}/js/bootstrap-timepicker.js"></script>
    <script>
		$('input.date-pick').datepicker('setDate', 'today');
	</script>
    <script>
         $('#date_start, #date_return').change(function (e) { 
            var dateStart = $('#date_start').val();
            var dateReturn =$('#date_return').val();
            var totalDate = datediff(parseDate(dateStart), parseDate(dateReturn));
           
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today =  yyyy + '-' + mm + '-' + dd;
            if (totalDate > 12 || today > dateStart || today > dateReturn) {
                swal("Hệ thống lỗi", {
                    icon: "error",
                })
                .then(() => {
                    location.reload();
                }); 
            }
            
            var money = parseInt($('#money').val());
            if (today == dateReturn)
            {
               return $('#total-money').text(money);
            }

            if (today <= dateStart && today < dateReturn)
            {
                var days = parseInt(totalDate);
                $('#days').text(totalDate)
                $('#total-money').text(money * days);
            } else {
                $('#days').text(1);
            }
        });
        function parseDate(str) {
            var mdy = str.split('-');
            return new Date(mdy[1], mdy[0]-1, mdy[2]);
        }

        function datediff(first, second) {
            // Take the difference between the dates and divide by milliseconds per day.
            // Round to nearest whole number to deal with DST.
            return Math.round((second-first)/(1000*60*60*24));
        }
    </script>
	{{-- <!--Review modal validation -->
	<script src="assets/validate.js"></script> --}}
@endsection