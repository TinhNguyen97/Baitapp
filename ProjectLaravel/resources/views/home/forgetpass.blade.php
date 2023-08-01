@extends('home.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="{{ route('homes.checkforgetpass') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        @if (Session::has('check'))
                            <div class="alert alert-success">{{ Session::get('check') }}</div>
                        @endif
                        <h4>Lấy lại mật khẩu</h4>
                        <div class="space20">&nbsp;</div>
                        <p style="color:blue">Vui lòng nhập email mà bạn đã đăng ký trong hệ thống của chúng tôi.</p>

                        <div>
                            <label for="email">Email*</label>
                            <input type="email" name="email" placeholder="Nhập email">
                        </div>
                        @error('email')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Gửi email xác nhận</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
        </div>
        </form>
    </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
