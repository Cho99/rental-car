@extends('layouts.client.layout')

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>My Car</h1>
                <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
            </div>
        </div>
    </section>
    <!-- End section -->
    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li><a href="{{ route('create-step-one') }}">Car</a>
                    </li>
                    <li>Page active</li>
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
                    <p>
                        <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"
                            aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on
                            map</a>
                    </p>

                    <div class="box_style_cat">
                        <ul id="cat_nav">
                            <li><a href="{{ route('create-step-one') }}" id="active"><i class="icon-plus-circled-1"></i>Đăng ký xe</a>
                            </li>
                        </ul>
                    </div>

                    <!--End filters col-->
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                        <small>Monday to Friday 9.00am - 7.30pm</small>
                    </div>
                </aside>
                <!--End aside -->
                <div class="col-lg-9 col-md-9">

                    <div id="tools">

                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <div class="styled-select-filters">
                                    <select name="sort_price" id="sort_price">
                                        <option value="" selected>Trạng thái</option>
                                        <option value="">Đang chờ xác thực</option>
                                        <option value="lower">Đang chờ</option>
                                        <option value="higher">Đang thuê</option>
                                        <option value="higher">Từ chối</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/tools -->
                    
                    @foreach ($user->cars as $car)
                    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="img_list">
                                    @php
                                        $image = json_decode($car->image->image_list);
                                    @endphp
                                    <a href="single_tour.html"><img src="{{ asset('upload/car') . '/' . $image[0] }}" alt="Image">
                                        <div class="short_info"><i class="icon_set_1_icon-29"></i> <span>{{ $car->seats }}</span> Seats</div>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix visible-xs-block"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="tour_list_desc">
                                    <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile  voted"></i><i
                                            class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i
                                            class="icon-smile"></i><small>(75)</small>
                                    </div>
                                    <h3><strong>{{ $car->category->name }}</strong> Đời: {{ date('Y', strtotime($car->year_of_product)) }}</h3>
                                    <p>Biển số xe: {{ $car->license_plates }}</p>
                                    <p>Điều khoản: {{ $car->description }}</p>
                                    <ul class="add_info">
                                        @foreach ($car->features as $feature)
                                            <li>
                                                <div class="tooltip_styled tooltip-effect-4">
                                                    <span class="tooltip-item">
                                                        <img src="{{ asset('upload/feature/'. $feature->image) }}" alt="" style="max-width: 35px; height: 35px; object-fit: cover;">
                                                    </span>
                                                    <div class="tooltip-content">
                                                        <h4>{{ $feature->name }}</h4>
                                                        <br>
                                                        <strong>Saturday</strong>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="price_list">
                                    <div>{{ $car->price }}<sup>K</sup>
                                        <span class="normal_price_list">{{ $car->discount }} %</span>
                                        <br>
                                        <p>
                                            <a href="single_tour.html" class="btn_1">Details</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                
                    <!--End strip -->


                    <hr>

                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">Prev</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
    <!-- End main -->

@endsection
