@extends('layouts.client.layout')

@section('content')
    <section id="search_container">
        <div id="search">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#transfers" data-toggle="tab"> <span class="pe-7s-car"></span> Xe tự lái</a>
                </li>
            </ul>

            <div class="tab-content">
                <form action="">
                    <div class="tab-pane active" id="transfers">
                        <h3>Thuê xe tự lái</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="select-label">Địa điểm</label>
                                    <input class="form-control" type="text" value="Hà nội"
                                        placeholder="Nhập thành phố quân địa chỉ...">
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <hr>
                        <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                </form>
            </div>
        </div>
        </div>
    </section>
    <!-- End hero -->

    <main>
        <div class="container margin_60">

            <div class="main_title">
                <h2>Xe giảm giá</h2>
            </div>

            <div class="row">
                @foreach ($carDiscounts as $carDiscount)
                    <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                        <div class="ribbon_3 popular"><span>SEAL</span></div>
                        <div class="tour_container">
                            <div class="img_container">
                                <a href="{{ route('cars.show', $carDiscount->id) }}">
                                    @php
                                        $image = null;
                                        if (!empty($carDiscount->image)) {
                                            $image = json_decode($carDiscount->image->image_list);
                                        }
                                    @endphp
                                    @if (isset($image))
                                        <img src="{{ asset('upload/car/'. $image[0]) }}" alt="{{ $carDiscount->category->name }}" class="img-responsive" alt="Image">
                                    @else
                                        <img src="{{ asset('images/car.jpg') }}" alt="Car Rental" class="img-responsive" alt="Image">    
                                    @endif
                                    <div class="badge_save">SEAL<strong>{{ $carDiscount->discount }}%</strong></div>
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-29"></i>{{ $carDiscount->seats }} Seats<span
                                            class="price">{{ currency_format($carDiscount->price) }}<sup>VNĐ</sup></span>
                                    </div>
                                </a>
                            </div>
                            <div class="tour_title">
                                <h3><strong>{{ $carDiscount->category->name }}</strong> - {{ date('Y', strtotime($carDiscount->year_of_product)) }}</h3>
                                <div class="rating">
                                    <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                        class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                        class="icon-smile"></i><small>(75)</small>
                                </div>
                                <!-- end rating -->
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span
                                            class="tooltip-content-flip"><span class="tooltip-back">Thuê Ngay</span></span></a>
                                </div>
                                <!-- End wish list-->
                            </div>
                        </div>
                        <!-- End box tour -->
                    </div>
                    <!-- End col-md-4 -->
                @endforeach
            </div>
            <!-- End row -->
            <p class="text-center nopadding">
                <a href="#" class="btn_1 medium"><i class="icon-eye-7"></i>Xem tất cả các xe ({{ $numberCar }}) </a>
            </p>
        </div>
        <!-- End container Xe nổi bật -->

        <div class="container margin_60">

            <div class="main_title">
                <h2>Danh sách xe</h2>
            </div>

            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                        <div class="ribbon_3 popular"><span>Popular</span></div>
                        <div class="tour_container">
                            <div class="img_container">
                                <a href="single_tour.html">
                                    <a href="{{ route('cars.show', $car->id) }}">
                                    @php
                                        $image = null;
                                        if (!empty($carDiscount->image)) {
                                            $image = json_decode($car->image->image_list);
                                        }
                                    @endphp
                                    @if (isset($image))
                                        <img src="{{ asset('upload/car/'. $image[0]) }}" alt="{{ $car->category->name }}" class="img-responsive" alt="Image">
                                    @else
                                        <img src="{{ asset('images/car.jpg') }}" alt="Car Rental" class="img-responsive" alt="Image">    
                                    @endif
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-29"></i>{{ $car->seats }} Seats<span
                                            class="price">{{ currency_format($car->price) }}<sup>VNĐ</sup></span>
                                    </div>
                                </a>
                            </div>
                            <div class="tour_title">
                                <h3><strong>{{ $carDiscount->category->name }}</strong> - {{ date('Y', strtotime($carDiscount->year_of_product)) }}</h3>
                                <div class="rating">
                                    <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                        class="icon-smile voted"></i><i class="icon-smile voted"></i><i
                                        class="icon-smile"></i><small>(75)</small>
                                </div>
                                <!-- end rating -->
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span
                                            class="tooltip-content-flip"><span class="tooltip-back">Add to
                                                wishlist</span></span></a>
                                </div>
                                <!-- End wish list-->
                            </div>
                        </div>
                        <!-- End box tour -->
                    </div>
                    <!-- End col-md-4 -->
                @endforeach
            </div>
            <!-- End row -->
            <p class="text-center nopadding">
                <a href="#" class="btn_1 medium"><i class="icon-eye-7"></i>Xem tất cả các xe ({{ $numberCar }}) </a>
            </p>
        </div>
        <!-- End container Xe nổi bật -->

        <div class="white_bg">
            <div class="container margin_60">
                <div class="main_title">
                    <h2>Địa điểm nổi bật tại Hà Nội</h2>
                </div>
                <div class="row add_bottom_45">
                    @foreach ($addresses as $address)
                        <div class="col-md-4 other_tours">
                            <ul>
                                <li><a href="#"><i class="icon_set_1_icon-37"></i>{{ $address->name }}<span
                                            class="other_tours_price"></span></a>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
                <!-- End row -->

                <div class="banner colored add_bottom_30">
                    <br>
                    <br>
                </div>
                <div class="row">
                    <div class="main_title">
                        <h2>Blogs</h2>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/bus.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>Sightseen tour</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor
                            imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/transfer.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>Transfer</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor
                            imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/guide.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>Tour guide</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor
                            imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/hotel.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>Hotel</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor
                            imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </div>
        <!-- End white_bg -->

        <section class="promo_full">
            <div class="promo_full_wp magnific">
                <div>
                    <h3>Thuê xe ở mọi chỗ trên Hà Nội</h3>
                    <p></p>
                    <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video"><i
                        class="icon-play-circled2-1"></i></a>
                </div>
            </div>
        </section>
        <!-- End section -->
    </main>
@endsection
