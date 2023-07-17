@extends('home.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="#" method="post" class="beta-form-checkout">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đăng nhập</h4>
                        <div class="space20">&nbsp;</div>


                        <div>
                            <label for="email">Email*</label>
                            <input type="email" name="email" required>
                        </div>
                        <div>
                            <label for="password">Password*</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-block">
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
