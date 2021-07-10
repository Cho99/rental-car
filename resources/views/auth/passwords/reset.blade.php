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
                        <form method="POST"action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                            <div class="form-group">
                                <label for="password">Nhập lại mật khẩu</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn_full">Thay đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
