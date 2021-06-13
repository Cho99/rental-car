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
                <form action="{{ route('list-car') }}" method="GET">
                    <div class="tab-pane active" id="transfers">
                        <h3>Thuê xe tự lái</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="select-label">Địa điểm</label>
                                    <input class="form-control" type="text" value="Hà nội" name="address"
                                        placeholder="Nhập thành phố quân địa chỉ...">
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <hr>
                        <button class="btn_1 green"><i class="icon-search"></i>Tìm kiếm</button>
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
                        <div class="ribbon_3 popular"><span>Giảm giá</span></div>
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
                                    <div class="badge_save">Giảm giá<strong>{{ $carDiscount->discount }}%</strong></div>
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-29"></i>{{ $carDiscount->seats }} Seats<span
                                            class="price">{{ currency_format($carDiscount->price) }}<sup>VNĐ</sup></span>
                                    </div>
                                </a>
                            </div>
                            <div class="tour_title">
                                <h3><strong>{{ $carDiscount->category->name }}</strong> - {{ date('Y', strtotime($carDiscount->year_of_product)) }}</h3>
                                <div class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i < $carDiscount->comments()->avg('rate'))
                                            <i class="icon-smile voted"></i>
                                        @else
                                            <i class="icon-smile"></i>
                                        @endif
                                    @endfor
                                    <small>({{ $carDiscount->comments_count }}) Đánh giá</small>
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
                <a href="{{ route('list-car') }}" class="btn_1 medium"><i class="icon-eye-7"></i>Xem tất cả các xe ({{ $numberCar }}) </a>
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
                                <h3><strong>{{ $car->category->name }}</strong> - {{ date('Y', strtotime($carDiscount->year_of_product)) }}</h3>
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
                <a href="{{ route('list-car') }}" class="btn_1 medium"><i class="icon-eye-7"></i>Xem tất cả các xe ({{ $numberCar }}) </a>
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
                        <h2>Bảng tin</h2>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/bus.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>TOP NHỮNG GARAGE SỮA CHỮA/BẢO DƯỠNG</span> Ô TÔ UY TÍN VÀ CHẤT LƯỢNG NHẤT HIỆN NAY</h4>
                        <p>
                            Mỗi quốc gia sẽ có những tiêu chí riêng để xếp loại các phân khúc xe ô tô. Nếu thị trường Mỹ dựa vào kích thước khung xe và động cơ, thị trường Nhật phân theo pháp luật, tạp chí chuyên ngành và các nhà chế tạo ô tô, thì ở Việt Nam, 3 yếu tố cơ bản để phân biệt các mẫu xe chính là dung tích động cơ, kích thước và giá cả. Phân biệt được những khái niệm này là điều không hề đơn giản đối với những người mới tìm hiểu về xe. Chính vì vậy, hôm nay, Mioto sẽ cùng bạn nhận biết những dấu hiệu của từng phân khúc xe!.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/transfer.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>NHỮNG MẪU XE BÁN TẢI NỔI BẬT TRONG TẦM GIÁ 600 TRIỆU</span></h4>
                        <p>
                            Dưới sự ảnh hưởng của khí hậu, thời tiết, cùng với sự tác động của thời gian, chiếc xe ô tô của bạn có thể sẽ gặp phải tình trạng xuống cấp, hao mòn, giảm chất lượng, giảm chi tiết, chất bôi trơn và các dung dịch khác trên xe,… Do đó, để chiếc xe của bạn luôn ở trong tình trạng an toàn, vận hành trơn tru thì việc mang chiếc xế hộp đến các garage để kiểm tra, sửa chữa và bảo dưỡng định kỳ là điều rất cần thiết.  Để chiếc xe của bạn được bảo hành đúng cách, sữa chữa đúng chỗ thì việc chọn một garage uy tín và chất lượng cũng rất quan trọng. Dành cho những ai đang băn khoăn không biết nên ghé thăm garage nào, Mioto sẽ gợi ý giúp bạn một vài địa chỉ garage đáng tin cậy nhất hiện nay.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/guide.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>CÙNG Rental Car PHÂN BIỆT CÁC PHÂN KHÚC XE Ô TÔ TẠI THỊ TRƯỜNG</span> VIỆT NAM</h4>
                        <p>
                            Với sự thuận tiện về ứng dụng và hiện đại về thiết kế, trang thiết bị, dòng xe bán tải ngày càng được ưa chuộng tại Việt Nam. Xe bán tải, hay còn gọi là xe Pick-up, rất phổ biến tại Việt Nam và các quốc gia đang phát triển bởi tính đa dụng trong đời sống hàng ngày, không chỉ trong việc chuyên chở hàng hóa mà còn trong việc đáp ứng nhu cầu cá nhân.
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="{{ asset('bower_components/car-client-lte') }}/img/hotel.jpg" alt="Pic" class="img-responsive"></a>
                        </p>
                        <h4><span>Rental Car - Thuê xe tự lái</span> booking</h4>
                        <p>
                            Khi nhắc đến dịp tết dương lịch, có lẽ bạn sẽ nghĩ ngay đến những chuyến tham quan vi vu khắp chốn cùng gia đình và bạn bè. Vậy năm nay, bạn đã có kế hoạch đi đâu trong những ngày nghỉ quý giá của mình chưa? Nếu chưa, hãy để Mioto gợi ý giúp bạn một số địa điểm du lịch hấp dẫn mà bạn có thể ghé thăm trong dịp đầu năm mới nhé.
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
