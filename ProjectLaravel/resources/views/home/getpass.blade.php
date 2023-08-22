@extends('layouts.homelayout')
@section('content')
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
