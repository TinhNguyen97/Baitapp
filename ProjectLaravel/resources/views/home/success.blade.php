@extends('home.homelayout')
@section('content')
    <div class="alert alert-success flex-success">
        <h3>Đặt hàng thành công!Vui lòng kiểm tra email!</h3>


    </div>
    <div style="text-align: center">
        <p><a class="btn btn-success" href="https://gmail.com" target="_blank"> Mở email của bạn</a></p>
    </div>
    <div class="redirect-home"><a href="{{ route('homes.index') }}">
            <h3>Quay về trang chủ</h3>
        </a></div>
    <style>
        .flex-success {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px 0px;
        }

        h1 {
            display: inline;
        }

        .redirect-home {
            text-align: center;
        }
    </style>
@endsection
