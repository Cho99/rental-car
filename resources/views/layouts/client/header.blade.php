<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong>0045 043204434</strong></div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul id="top_links">

                        @auth
                            <li>
                                <div class="dropdown dropdown-mini">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="access_link"
                                        aria-expanded="true">{{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu">
                                        <ul id="lang_menu">
                                            <li><a href="">My Account</a>
                                            </li>
                                            <li><a href="{{ route('cars.index') }}">My Car</a>
                                            </li>
                                            <li><a href="{{ route('my_orders.index') }}">My Request</a>
                                            </li>
                                            <li><a href="{{ route('orders.index') }}">Order Request</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endauth
                        @guest
                            <li><a href="{{ route('login') }}" id="">Đăng nhập</a></li>
                            <li><a href="" id="">Đăng ký</a></li>
                        @endguest
                        @auth
                            <li>
                                <a class="logout" id="logout">Logout</a>
                            </li>
                        @endauth
                        <li>
                            <div class="dropdown dropdown-mini">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="lang_link"
                                    aria-expanded="true">Tiếng việt</a>
                                <div class="dropdown-menu">
                                    <ul id="lang_menu">
                                        <li><a href="#0">Tiếng Anh</a>
                                        </li>
                                        <li><a href="#0">Tiếng Việt</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Dropdown access -->
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container-->
    </div>
    <!-- End top line-->

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <a href="{{ route('home') }}" title="City tours travel template">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 50px">
                    Rental Car
                </a>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
                <!-- End main-menu -->
                <ul id="top_tools">
                    <li>
                        <div class="dropdown dropdown-search">
                            <a href="#" class="search-overlay-menu-btn" data-toggle="dropdown"><i
                                    class="icon-search"></i></a>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown dropdown-cart">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-bell"></i>Thong
                                Bao</a>
                            <ul class="dropdown-menu" id="cart_items">
                                <li>
                                    <div class="image"><img
                                            src="{{ asset('bower_components/car-client-lte') }}/img/thumb_cart_1.jpg"
                                            alt="image"></div>
                                    <strong>
                                        <a href="#">Louvre museum</a>1x $36.00 </strong>
                                </li>
                            </ul>
                        </div>
                        <!-- End dropdown-cart-->
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- container -->
</header>