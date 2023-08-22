@extends('layouts.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="{{ route('homes.changepassword') }}" method="post" class="beta-form-checkout">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-sm-3"> </div>
                    <div class="col-sm-6">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        <h4>Đổi mật khẩu</h4>
                        <div class="space20">&nbsp;</div>
                        <div>
                            <label for="current_pass">Mật khẩu hiện tại*</label>
                            <input name="current_pass" type="password">
                        </div>
                        @if (Session::has('duplicate'))
                            <span style="color:red">{{ Session::get('duplicate') }}</span>
                        @endif
                        @error('current_pass')
                            <span style="color:red">{{ $message }}</span>
                        @enderror

                        <div>
                            <label for="new_pass">Mật khẩu mới*</label>
                            <input name="new_pass" type="password">
                        </div>
                        @error('new_pass')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div>
                            <label for="renew_pass">Nhập lại mật khẩu mới*</label>
                            <input name="renew_pass" type="password">
                        </div>
                        @error('renew_pass')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div>
                            @if (Auth::check())
                                <button type="button" class="btn" style="border: 1px solid #e1e1e1"><a
                                        href="{{ route('homes.index') }}">Hủy
                                        bỏ</a></button>
                            @endif
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
    </div>
    <style>
        input[type="password"] {
            width: 100%;
            height: 35px;
            border: 1px solid #e1e1e1;
            padding: 0px 12px;
        }
    </style>
@endsection
