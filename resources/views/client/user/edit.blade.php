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
                                <img src="{{ asset('upload/car/'. Auth::user()->avatar) }}" alt="" class="img-circle" width="68px" height="68px">
                            @else 
                                <img src="{{ asset('bower_components/car-client-lte/' . '/img/avatar3.jpg') }}" alt="" class="img-circle">
                            @endif 
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="form-group">
                                <label>{{ Auth::user()->name }}</label>
                                <div>
                                    <label>Email: </label>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6  col-sm-6">
                                <Label>Ngày sinh:</Label>
                                <div class="form-group">
                                    <input type="date" class="form-group" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}">
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6">
                                <label>Giới tính</label>
                                <div class="form-group">
                                    <input type="radio" value="1" name="sex" class="form-group" {{ Auth::user()->sex === 1 ? 'checked' : '' }}> Nam
                                    <input type="radio" value="2" name="sex" class="form-group"  {{ Auth::user()->sex === 2  ? 'checked' : '' }}> Nữ
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  col-sm-6">
                                <label>Số điện thoại</label>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-group" value="{{ Auth::user()->phone }}">
                                </div> 
                            </div>
                            <div class="col-md-6  col-sm-6">
                                <img id="img" style="with: 75px">
                            </div>
                            @if ($errors->has('phone'))
                                <div class="error">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Bằng lái xe</label>
                                    <input type="file" class="form-group" name="image" multiple>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                        <button class="btn_full" type="submit">Lưu thông <i class="fas fa-tint-slash"></i></button>
                    </form>
                </div>
            </aside> 
        </div>
    </div>
</main>
@endsection
