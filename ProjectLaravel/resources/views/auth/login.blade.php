@extends('layouts.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="{{ route('homes.checklogin') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        @if (Session::has('changepasssuccess'))
                            <div class="alert alert-success">{{ Session::get('changepasssuccess') }}</div>
                        @endif
                        @if (Session::has('check'))
                            <div class="alert alert-success">{{ Session::get('check') }}</div>
                        @endif
                        <h4>Đăng nhập</h4>
                        <div class="space20">&nbsp;</div>


                        <div>
                            <label for="email">Email*</label>
                            <input type="email" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                        <div>
                            <label for="password">Mật khẩu*</label>
                            <input type="password" name="password">
                        </div>
                        @error('password')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                        <div class="checkbox d-flex">
                            <div><input type="checkbox" name="remember"><span>Nhớ đăng nhập</span></div>
                            <div><span>Bạn quên mật khẩu?</span><a style="color:blue"
                                    href="{{ route('homes.forgetpass') }}"> click vào đây</a>
                            </div>
                        </div>
                        <div class="form-block">
                            @if (Session::has('error'))
                                <div style="color: red">{{ Session::get('error') }}</div>
                            @endif
                            @if (Session::has('ban'))
                                <div style="color: red">{{ Session::get('ban') }}</div>
                            @endif
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
    <style>
        input[type="password"] {
            width: 100%;
            height: 35px;
            border: 1px solid #e1e1e1;
            padding: 0px 12px;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection
