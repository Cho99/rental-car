@component('mail::message')
@component('mail::panel')
<div class="header">
    <img src="{{ asset('/images/logo.png') }}" style="with: 80px"> 
</div> 
@endcomponent
<span>Xin Chào, {{ $data['user'] }}</span> 
<div><span>Chủ xe: {{ $data['owner'] }}</span> Đã chấp thuận đơn của bạn</div>
<span>Số điện thoại: {{ $data['phone'] }}</span>
<div>Đơn: {{ $data['order_id'] }} <strong>Đã được chấp thuận </strong> </div> 
<div><strong>Hãy liên lạc với chủ xe hoặc chờ đợi chủ xe sẽ liên lạc với bạn trong ngày</strong></div>
<br>
Cảm ơn bạn đã dùng dịch vụ, {{ $data['user'] }}
<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent