@extends('home.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="{{ route('homes.checklogin') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
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
                            <label for="password">Password*</label>
                            <input type="password" name="password">
                        </div>
                        @error('password')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                        <div class="form-block">
                            @if (Session::has('error'))
                                <div style="color: red">{{ Session::get('error') }}</div>
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
            width: 555px;
            height: 35px;
            border: 1px solid #e1e1e1;
            padding: 0px 12px;
        }
    </style>
@endsection
