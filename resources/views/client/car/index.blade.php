@extends('layouts.client.layout')

@section('content')
    <section class="parallax-window" data-parallax="scroll"
        data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>Xe của tôi</h1>
            </div>
        </div>
    </section>
    <!-- End section -->
    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li><a href="{{ route('create-step-one') }}">Xe</a>
                    </li>
                    <li>Danh sách xe</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="collapse" id="collapseMap">
            <div id="map" class="map"></div>
        </div>
        <!-- End Map -->


        <div class="container margin_60">

            <div class="row">
                <aside class="col-lg-3 col-md-3">
                    <div class="box_style_cat">
                        <ul id="cat_nav">
                            <li><a href="{{ route('create-step-one') }}" id="active"><i
                                        class="icon-plus-circled-1"></i>Đăng ký xe</a>
                            </li>
                        </ul>
                    </div>

                    <!--End filters col-->
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Liên hệ</h4>
                        <a href="tel://004542344599" class="phone">+84 423 445 99</a>
                        <small>Thứ hai đến thứ Sáu 9.00 sáng - 7.30 tối</small>
                    </div>
                </aside>
                <!--End aside -->
                <div class="col-lg-9 col-md-9">

                    <div id="tools">

                    </div>
                    <!--/tools -->

                    @forelse  ($cars as $car)
                        <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    @switch($car->status)
                                        @case(0)
                                            <div class="ribbon_3 info">
                                                <span>Đang chờ</span>
                                            </div>
                                        @break
                                        @case(1)
                                            <div class="ribbon_3">
                                                <span>Từ chối</span>
                                            </div>
                                        @break
                                        @case(2)
                                            <div class="ribbon_3 success">
                                                <span>Được lưu hành</span>
                                            </div>
                                        @break
                                        @case(3)
                                            <div class="ribbon_3 warning">
                                                <span>Đang thuê</span>
                                            </div>
                                        @case(4)
                                            <div class="ribbon_3 danger">
                                                <span>Bị khóa</span>
                                            </div>
                                        @break
                                        @default

                                    @endswitch


                                    <div class="img_list">
                                        @php
                                            $image = null;
                                            if (!empty($car->image)) {
                                                $image = json_decode($car->image->image_list);
                                            }
                                        @endphp
                                        @if (isset($image))
                                            <a href="{{ route('cars.show', $car->id) }}"><img
                                                    src="{{ asset('upload/car') . '/' . $image[0] }}" alt="Image">
                                                <div class="short_info"><i class="icon_set_1_icon-29"></i>
                                                    <span>{{ $car->seats }}</span> Seats
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{ route('cars.show', $car->id) }}"><img
                                                    src="{{ asset('images/car.jpg') }}" alt="Image">
                                                <div class="short_info"><i class="icon_set_1_icon-29"></i>
                                                    <span>{{ $car->seats }}</span> Seats
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                            </div>
                            <div class="clearfix visible-xs-block"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="tour_list_desc">
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i < $car->comments()->avg('rate'))
                                                <i class="icon-smile voted"></i>
                                            @else
                                                <i class="icon-smile"></i>
                                            @endif
                                        @endfor
                                        <small>({{ $car->comments_count }}) Đánh giá</small>
                                    </div>
                                    <h3><strong>{{ $car->category->name }}</strong> Đời:
                                        {{ date('Y', strtotime($car->year_of_product)) }}</h3>
                                    <p>Biển số xe: {{ $car->license_plates }}</p>
                                    <p>Điều khoản: {{ $car->description }}</p>
                                    <ul class="add_info">
                                        @foreach ($car->features as $feature)
                                            <li>
                                                <div class="tooltip_styled tooltip-effect-4">
                                                    <span class="tooltip-item">
                                                        <img src="{{ asset('upload/feature/' . $feature->image) }}"
                                                            alt=""
                                                            style="max-width: 35px; height: 35px; object-fit: cover;">
                                                    </span>
                                                    <div class="tooltip-content">
                                                        <h4>{{ $feature->name }}</h4>
                                                        <br>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="price">
                                    <h5>{{ currency_format($car->price) }} VNĐ</h5>
                                    @if ($car->discount)
                                        <span class="normal_price_list">Giảm giá: {{ $car->discount }} %</span>
                                    @endif
                                    <br>
                                    <div>
                                        <a href="{{ route('cars.show', $car->id) }}" class="btn_1">Chi
                                            Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @empty
                        <hr>
                        <h2>Chưa có xe nào quản lý</h2>

                    @endforelse

                    <!--End strip -->




                    @if ($cars->lastPage() > 1)
                        <div class="text-center">
                            <ul class="pagination">
                                <li class="{{ $cars->currentPage() == 1 ? ' disabled' : '' }}">
                                    <a href="{{ $cars->url(1) }}">Trang trước</a>
                                </li>
                                @for ($i = 1; $i <= $cars->lastPage(); $i++)
                                    <li class="{{ $cars->currentPage() == $i ? ' active' : '' }}">
                                        <a href="{{ $cars->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="{{ $cars->currentPage() == $cars->lastPage() ? ' disabled' : '' }}">
                                    <a href="{{ $cars->url($cars->currentPage() + 1) }}">Trang tiếp</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
    <!-- End main -->

@endsection
