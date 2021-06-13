@extends('layouts.client.layout')

@section('css')
    <link href="{{ asset('bower_components/car-client-lte') }}/css/skins/square/grey.css" rel="stylesheet">
@endsection

@section('content')
    <section id="hero_2">
        <div class="intro_title animated fadeInDown">
            <h1>Đăng ký xe</h1>
            <div class="bs-wizard">
                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum">Đăng ký thông tin cơ bản</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ route('create-step-one') }}" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
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
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">Đăng ký xe</a>
                    </li>
                    <li>Page active</li>
                </ul>
            </div>
        </div>
        <!-- End position -->

        <div class="container margin_60">
            <form action="{{ route('create-step-two') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 add_bottom_15">
                        <div class="form_title">
                            <h3><strong>1</strong>Biển số xe</h3>
                            <p>
                                Lưu ý: Biển số sẽ không thể thay đổi sau khi đăng kí.
                            </p>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="license_plates">Biển số xe</label>
                                        <input type="text" class="form-control" id="license_plates" name="license_plates" required>
                                    </div>
                                    @if ($errors->has('license_plates'))
                                        <div class="error">{{ $errors->first('license_plates') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--End step -->

                        <div class="form_title">
                            <h3><strong>2</strong>Thông tin cơ bản</h3>
                            <p>
                                Lưu ý: Các thông tin cơ bản sẽ không thể thay đổi sau khi đăng kí.
                            </p>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="trademark">Hãng xe</label>
                                        <select class="form-control" name="trademark" id="trademark">
                                            <option value="0">Chọn hãng xe</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('trademark'))
                                            <div class="error">{{ $errors->first('trademark') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Mẫu xe</label>
                                        <select class="form-control" name="vehicle" id="vehicle" disabled>
                                            <option>Chọn hãng xe trước</option>
                                        </select>
                                        @if ($errors->has('vehicle'))
                                            <div class="error">{{ $errors->first('vehicle') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Số ghế</label>
                                        <input type="number" id="seats" name="seats" class="form-control">
                                    </div>
                                    @if ($errors->has('vehicle'))
                                        <div class="error">{{ $errors->first('seats') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Năm sẩn xuất</label>
                                        <input type="number" id="year_of_product" name="year_of_product"
                                            class="form-control">
                                    </div>
                                    @if ($errors->has('year_of_product'))
                                        <div class="error">{{ $errors->first('year_of_product') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Truyền động</label>
                                        <select class="form-control" name="actions" id="actions">
                                            <option value="1">Số tự động</option>
                                            <option value="2">Số côn</option>
                                        </select>
                                        @if ($errors->has('actions'))
                                            <div class="error">{{ $errors->first('actions') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Loại nhiên liệu</label>
                                        <select class="form-control" name="type_of_fuel" id="type_of_fuel">
                                            <option value="1">Xăng</option>
                                            <option value="2">Dầu</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('type_of_fuel'))
                                        <div class="error">{{ $errors->first('type_of_fuel') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!--End row -->
                        </div>
                        <!--End step -->

                        <div class="form_title">
                            <h3><strong>3</strong>Mức tiêu thụ nhiên liệu</h3>
                            <p>
                                Số lít nhiên liệu cho quãng đường 100km.
                            </p>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="fuel_consumption" name="fuel_consumption" class="form-control">
                                </div>
                            </div>
                            @if ($errors->has('fuel_consumption'))
                                <div class="error">{{ $errors->first('fuel_consumption') }}</div>
                            @endif
                            <!--End row -->
                        </div>
                        <!--End step -->
                        <div class="form_title">
                            <h3><strong>4</strong>Địa chỉ</h3>
                            <p>
                                Địa điểm trong vùng Hà Nội mà xe bạn đang ở, nó chưa phải là điểm cụ thể nhưng hãy chọn đúng với nơi bạn gần nhất để mà người dùng có thể tìm kiếm tới bạn
                            </p>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="address">Địa điểm</label>
                                        <select class="form-control" name="address" id="address">
                                            <option>Chọn phường</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}">{{ $address->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End step -->
                        <div class="form_title">
                            <h3><strong>5</strong>Tính năng</h3>
                        </div>
                        <div class="step">
                            <div class="row">
                                @foreach ($features as $feature)
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="checkbox" id="street_1" name="feature[]" class="form-control"
                                                value="{{ $feature->id }}">{{ $feature->name }}
                                        </div>
                                    </div>
                                    @if ($errors->has('feature'))
                                        <div class="error">{{ $errors->first('feature') }}</div>
                                    @endif
                                @endforeach
                            </div>
                            <!--End row -->
                        </div>
                        <div id="policy">
                            <button type="submit" class="btn_1 green medium">Kế tiếp</button>
                        </div>
                    </div>
                </div>
                <!--End row -->
            </form>
        </div>
        <!--End container -->
    </main>
    {{-- @dd(Session::get('car')); --}}
@endsection

@section('script')
    <script src="{{ asset('bower_components/car-client-lte') }}/js/icheck.js"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });
    </script>
    <script>
        var url = window.location.origin;
        $('#trademark').change(function(e) {
            var trademark = $(this).val();
            if (trademark == 0) {
                $('#vehicle').prop('disabled', true);
                var html = `<option>Chọn hãng xe trước</option>`
                return $('#vehicle').html(html);
            }
            $.ajax({
                type: "get",
                url: url + /vehicles/ + trademark,
                dataType: 'json',
                data: {
                    'id': trademark
                },
                success: function(response) {
                    if (response.length > 0) {
                        $('#vehicle').prop('disabled', false);
                    }
                    var html = ''
                    response.map(function(item) {
                        return html += `
                                    <option value="${item.id}">${item.name}</option>
                                `
                    });
                    $('#vehicle').append(html);
                }
            });
        });

    </script>
@endsection
