@extends('home.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="{{ route('homes.checkregister') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>


                        <div>
                            <label for="email">Email*</label>
                            <input name="email" type="email" id="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span style="color:red">{{ $message }}</span>
                        @enderror

                        <div>
                            <label for="name">Họ và tên*</label>
                            <input name="full_name" type="text" id="name" value="{{ old('full_name') }}">
                        </div>
                        @error('full_name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror

                        <div>
                            <label for="address">Địa chỉ*</label>
                            <input name="address" type="text" id="address" value="{{ old('address') }}">
                        </div>
                        @error('address')
                            <span style="color:red">{{ $message }}</span>
                        @enderror


                        <div>
                            <label for="phone">SĐT*</label>
                            <input name="phone" type="text" id="phone" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div>
                            <label for="password">Mật khẩu*</label>
                            <input name="password" type="password" id="password">
                        </div>
                        @error('password')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div>
                            <label for="re_pass">Nhập lại mật khẩu*</label>
                            <input name="re_pass" type="password" id="re_pass">
                        </div>
                        @error('re_pass')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div>
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
    </div>
    <style>
        input[type="password"] {
            width: 555px;
            height: 35px;
            border: 1px solid #e1e1e1;
            padding: 0px 12px;
        }
    </style>
@endsection
