@extends('home.homelayout')
@section('content')
    <div class="bg-h">
        <div class="success">
            <h3>Đặt hàng thành công! Đơn hàng của bạn đã được gửi đi!</h3>
        </div>
    </div>
    <style>
        .success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            text-align: center
        }

        .bg-h {
            height: 50vh;
            align-items: center;
            justify-content: center;
            display: flex;
        }
    </style>
@endsection
