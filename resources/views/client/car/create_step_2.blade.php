@extends('layouts.client.layout')

@section('content')
    <section id="hero_2">
        <div class="intro_title animated fadeInDown">
            <h1>Điện thông tin về giá cả</h1>
            <div class="bs-wizard">

                <div class="col-xs-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum">Đăng ký thông tin cơ bản</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ route('create-step-one') }}" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum">Thông tin về giá cả</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ route('create-step-two') }}" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum">Hoàn thành</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ route('create-step-three') }}" class="bs-wizard-dot"></a>
                </div>

            </div>
            <!-- End bs-wizard -->
        </div>
        <!-- End intro-title -->
    </section>
    <div class="container margin_60">
        <h2 style="text-align: center">Car Number: {{ $carNumber }}</h2>
        <div class="row">
            <form action="{{ route('create-step-three') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="form_title">
                        <h3><strong>5</strong>Giá Thuê</h3>
                        <p>
                            Đơn giá áp dụng cho tất cả các ngày. Bạn có thuể tuỳ chỉnh giá khác cho các ngày đặc biệt (cuối
                            tuần, lễ, tết...) trong mục quản lý xe sau khi đăng kí.
                        </p>
                        <strong>Giá đề xuất: 2800K</strong>
                    </div>
                    <div class="step">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="price" name="price" autofocus required>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('price'))
                            <div class="error">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <!--End step -->
                    <div class="form_title">
                        <h3><strong>6</strong>Giảm giá</h3>
                        <p>
                            Giảm giá thuê tuần (% trên đơn giá)
                        </p>
                    </div>
                    <div class="step">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="discount" name="discount">
                                </div>
                            </div>
                            @if ($errors->has('discount'))
                                <div class="error">{{ $errors->first('discount') }}</div>
                            @endif
                        </div>
                    </div>
                    <!--End step -->
                    <div class="form_title">
                        <h3><strong>7</strong>Giới hạn số km</h3>
                        <p>
                            Số km tối đa trong 1 ngày
                        </p>
                    </div>
                    <div class="step">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="limited_km">Số km giới hạn trong một ngày</label>
                                    <input type="number" class="form-control" id="limited_km" name="limited_km" required>
                                </div>
                                @if ($errors->has('limited_km'))
                                    <div class="error">{{ $errors->first('limited_km') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="limit_pass_fee">Phí vượt giới hạn(tính mỗi km)</label>
                                    <input type="number" class="form-control" id="limit_pass_fee" name="limit_pass_fee"
                                        required>
                                </div>
                                @if ($errors->has('limit_pass_fee'))
                                    <div class="error">{{ $errors->first('limit_pass_fee') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--End step -->
                    <div class="form_title">
                        <h3><strong>7</strong>Điều khoản</h3>
                    </div>
                    <div class="step">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="description"> Ghi rõ các yêu cầu để khách có thể thuê xe.</label>
                                    <textarea name="description" class="form-control" id="description" cols="30"
                                        rows="10"></textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <div class="error">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--End step -->
                    <div class="add_bottom_15">
                        <button type="submit" class="btn_1 green medium">Kế tiếp</button>
                    </div>
                </div>
            </form>
            <!-- End col-md-8 -->
        </div>
        <!--End row -->
    </div>
@endsection
