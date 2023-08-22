@extends('layouts.homelayout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/inputpassword.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dflex.css') }}">
    <div class="container">
        <div id="content">

            <form action="" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        <h4>Đặt lại mật khẩu</h4>
                        <div class="space20">&nbsp;</div>

                        <div>
                            <label for="password">Mật khẩu mới*</label>
                            <input type="password" name="password">
                        </div>
                        @error('password')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                        <div>
                            <label for="password">Nhập lại mật khẩu*</label>
                            <input type="password" name="re-password">
                        </div>
                        @error('re-password')
                            <div style="color: red">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
        </div>
        </form>
    </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
