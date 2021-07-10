@extends('layouts.client.layout')

@section('content')
<main>
    <section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        <div class="text-center"> <img src="{{ asset('images/logo.png') }}" alt="" style="width: 50px">
                            Rental Car
                        </div>
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                Gửi email thay quên mật khẩu thành công
                            </div>
                        @endif
                            <br>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn_full">Quên mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

 