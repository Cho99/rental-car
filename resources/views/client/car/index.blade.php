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
                            <li><a href="#"><i class="icon_set_1_icon-3"></i>City sightseeing <span>(20)</span></a>
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
                                        <option value="">Sort by price</option>
                                        <option value="lower">Lowest price</option>
                                        <option value="higher">Highest price</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/tools -->

                    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="ribbon_3 popular"><span>Popular</span>
                                </div>
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span
                                            class="tooltip-content-flip"><span class="tooltip-back">Add to
                                                wishlist</span></span></a>
                                </div>
                                <div class="img_list">
                                    <a href="single_tour.html"><img src="img/tour_box_1.jpg" alt="Image">
                                        <div class="short_info"><i class="icon_set_1_icon-4"></i>Museums </div>
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
                                    <h3><strong>Arch Triomphe</strong> tour</h3>
                                    <p>Lorem ipsum dolor sit amet, quem convenire interesset ut vix, ad dicat sanctus
                                        detracto vis. Eos modus dolorum ex, qui adipisci maiestatis inciderint no, eos in
                                        elit dicat.....</p>
                                    <ul class="add_info">
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Schedule</h4>
                                                    <strong>Monday to Friday</strong> 09.00 AM - 5.30 PM
                                                    <br>
                                                    <strong>Saturday</strong> 09.00 AM - 5.30 PM
                                                    <br>
                                                    <strong>Sunday</strong> <span class="label label-danger">Closed</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Address</h4> Musée du Louvre, 75058 Paris - France
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-97"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Languages</h4> English - French - Chinese - Russian - Italian
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-27"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Parking</h4> 1-3 Rue Elisée Reclus
                                                    <br> 76 Rue du Général Leclerc
                                                    <br> 8 Rue Caillaux 94923
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-25"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Transport</h4>
                                                    <strong>Metro: </strong>Musée du Louvre station (line 1)
                                                    <br>
                                                    <strong>Bus:</strong> 21, 24, 27, 39, 48, 68, 69, 72, 81, 95
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="price_list">
                                    <div><sup>$</sup>39*<span class="normal_price_list">$99</span><small>*Per person</small>
                                        <p><a href="single_tour.html" class="btn_1">Details</a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
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
