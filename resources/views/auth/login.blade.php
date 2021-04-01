@extends('layouts.client.layout')

@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div id="login">
                            <div class="text-center"> <img src="{{ asset('images/logo.png') }}" alt="" style="width: 50px">
                                Car Travel</div>
                            <hr>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 login_social">
                                        <a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i>
                                            Facebook</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 login_social">
                                        <a href="#" class="btn btn-info btn-block "><i class="icon-twitter"></i>Twitter</a>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="login-or">
                                    <hr class="hr-or"><span class="span-or">or</span>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
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
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                </p>
                                <button type="submit" class="btn_full">Signin</button>
                                <a href="register.html" class="btn_full_outline">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
