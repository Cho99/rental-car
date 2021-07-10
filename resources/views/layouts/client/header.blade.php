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
                                            <li><a href="{{ route('users.index') }}">Tài khoản</a>
                                            </li>
                                            <li><a href="{{ route('cars.index') }}">Quản lý xe</a>
                                            </li>
                                            <li><a href="{{ route('my_orders.index') }}">Quản lý yêu cầu thuê xe</a>
                                            </li>
                                            <li><a href="{{ route('orders.index') }}">Quản lý yêu cầu cho thuê xe</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endauth
                        @guest
                            <li><a href="{{ route('login') }}" id="">Đăng nhập</a></li>
                            <li><a href="{{ route('register') }}" id="">Đăng ký</a></li>
                        @endguest
                        @auth
                            <li>
                                <a class="logout" id="logout">Đăng xuất</a>
                            </li>
                        @endauth
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
                <a href="{{ route('home') }}" title="Thuê xe ô tô tự lái">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 50px">
                    Rental Car
                </a>
            </div>
        </div>
    </div>
    <!-- container -->
</header>