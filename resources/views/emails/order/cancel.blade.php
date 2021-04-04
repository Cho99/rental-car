@component('mail::message')
@component('mail::panel')
<div class="header">
    <img src="{{ asset('/images/logo.png') }}" style="with: 80px"> 
</div> 
@endcomponent
<span>Xin Chào, {{ $data['user'] }}</span> 
<div><span>Chủ xe: {{ $data['owner'] }}</span></div><strong>Đã từ chối đơn của bạn</strong>
<div>Đơn: {{ $data['order_id'] }} <strong>Đơn đã bị hủy</strong></div> 
<br>
Cảm ơn bạn đã dùng dịch vụ, {{ $data['user'] }}
<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent