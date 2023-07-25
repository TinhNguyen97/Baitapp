@extends('home.homelayout')
@section('content')
    <div class="alert alert-success flex-success">
        <h1>Đặt hàng thành công!</h1>

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
