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
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 login_social">
                                        <a href="#" class="btn btn-info btn-block">
                                            <i class="icon-google"></i>
                                            Google
                                        </a>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="login-or">
                                    <hr class="hr-or"><span class="span-or">Hoặc</span>
                                </div>

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
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <p class="small">
                                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                </p>
                                <button type="submit" class="btn_full">Đăng nhập</button>
                                <a href="{{ route('register') }}" class="btn_full_outline">Đăng ký</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
