@component('mail::message')
@component('mail::panel')
<div class="header">
    <img src="{{ asset('/images/logo.png') }}" style="with: 80px"> 
</div> 
@endcomponent
<span>Xin Chào, Chủ xe {{ $data['user'] }}</span> 
<div><span>Khách hàng: {{ $data['customer'] }}</span> Đã hủy đơn đặt xe</div>
<div>Đơn: {{ $data['order_id'] }} <strong>Đã bị hủy</strong></div> 
<br>
Cảm ơn bạn đã dùng dịch vụ, {{ $data['user'] }}
<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent