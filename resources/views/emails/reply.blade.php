@component('mail::message')
@component('mail::panel')
<div class="header">
    <img src="{{ asset('/images/logo.png') }}" style="with: 80px"> 
</div> 
@endcomponent
<br>
<span>Xin Chào, {{ $data['user_name'] }} </span> 
<p>Rental-Car xin thông báo về phản hồi của bạn: <strong>{{ $data['content'] }}</strong></p>

<strong>Note:</strong> Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi 

[RentalCar](http://127.0.0.1:8000) 

<br>
Cảm ơn bạn đã dùng dịch vụ, {{ $data['user_name'] }}
<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent




