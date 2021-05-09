@component('mail::message')
@component('mail::panel')
<div class="header">
    <img src="{{ asset('/images/logo.png') }}" style="with: 80px"> 
</div> 
@endcomponent
@php
    $yearOfProduct = \Carbon\Carbon::parse($data['year_of_product'])->year;
    $borrowDate = \Carbon\Carbon::parse($data['borrowed_date']);
    $returnDate = \Carbon\Carbon::parse($data['return_date']);
    $totalDate = $returnDate->diffinDays($borrowDate);
    $totalPrice = $data['price'];
    if ($data['discount']) {
        $totalPrice = (int)$data['price'] * (100 - (int)$data['discount']) / 100;
    }
@endphp
<br>
<span>Xin Chào, {{ $data['user']->name }} </span> 
<p>Xe của bạn là chiếc: <strong>{{ $data['name_car'] }} - {{ date('Y', strtotime($yearOfProduct)) }}</strong></p>
<p>Được yêu cầu thuê từ Anh/Chị: <strong>{{ $data['name'] }}</strong> thuê trong vòng <strong>{{ $totalDate }} ngày</strong></p> 
<p>Bắt đầu từ ngày: <strong>{{ date('d-m-Y', strtotime($borrowDate)) }}</strong></p> 
<p>Đến Ngày: <strong>{{ date('d-m-Y', strtotime($returnDate))  }}</strong></p> 
<p>Mức giảm giá là: <strong>{{ $data['discount'] }}%</strong></p>
<p>Giá ban đầu: <strong>{{ currency_format($data['price']) }} VNĐ</strong></p>
<p>Tổng tiền thuê: <strong>{{ currency_format($totalPrice) }} VNĐ</strong></p>
<strong>Note:</strong> Nếu đồng ý cho thuê xe hãy vào trang web để xác nhận yêu cầu, khi xác nhận yêu cầu xong thì sẽ hiện số điện thoại của người thuê để liên lạc. 

[RentalCar](http://127.0.0.1:8000) 

<br>
Cảm ơn bạn đã dùng dịch vụ, {{ $data['user']->name }}
<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent




