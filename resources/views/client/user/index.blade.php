@extends('layouts.client.layout')

@section('content')
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('bower_components/car-client-lte/') }}/img/transfer_1.jpg" data-natural-width="1400"
        data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Thông tin người dùng</h1>
            <p>{{ Auth::user()->name }}</p>
        </div>
    </div>
</section>
<main>
    <div class="container margin_60">
        <div class="row" style="display:flex;justify-content: center;">
            <aside class="col-md-6">
                <div class="box_style_1 expose" style="z-index: 4;">
                    <h3 class="inner">Thông tin người dùng</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            @if (Auth::user()->avatar)
                                <img src="" alt="" class="img-circle">
                            @else 
                                <img src="{{ asset('bower_components/car-client-lte/' . '/img/avatar3.jpg') }}" alt="" class="img-circle">
                            @endif 
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="form-group">
                                <label>{{ Auth::user()->name }}</label>
                                <div class="order-user--info">
                                    <label>Số điện thoại: </label> 
                                    <span class="label label-info">{{ Auth::user()->phone }}</span>                                     
                                </div>
                                <div>
                                    <label>Email: </label>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12  col-sm-12">
                            @if (Auth::user()->date_of_birth)
                                <label>Ngày sinh:</label> {{ Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d-m-Y') }}
                            @else
                                <Label>Ngày sinh:</Label><span>Chưa xác nhận</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12  col-sm-12">
                            @if (Auth::user()->sex === 1)
                                <label>Giới tính:</label><span> Nam</span>
                            @elseif (Auth::user()->sex === 2)
                                <Label>Giới tính:</Label><span> Nữ</span>
                            @else
                                <Label>Giới tính:</Label><span>Chưa xác nhận</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Bằng lái xe:</label>
                                @if (Auth::user()->gplx)
                                    <span>Đã xác nhận</span>
                                @else
                                    <span>Chưa xác nhận</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.edit', Auth::id()) }}" class="btn_full">Chỉnh sửa thông tin người dùng</a>
                </div>
            </aside> 
        </div>
    </div>
</main>
@endsection