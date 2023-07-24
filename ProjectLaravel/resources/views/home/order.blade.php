@extends('home.homelayout')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Checkout</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{ route('homes.index') }}">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <form action="#" method="post" class="beta-form-checkout">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Billing Address</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="your_first_name">First name*</label>
                            <input type="text" id="your_first_name" required>
                        </div>

                        <div class="form-block">
                            <label for="your_last_name">Last name*</label>
                            <input type="text" id="your_last_name" required>
                        </div>

                        <div class="form-block">
                            <label for="company">Company name</label>
                            <input type="text" id="company">
                        </div>

                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input type="text" id="adress" value="Street Address" required>
                            <input type="text" id="apartment" value="Apartment, suite, unit etc." required>
                        </div>

                        <div class="form-block">
                            <label for="town_city">Town / City*</label>
                            <input type="text" id="town_city" required value="Town / City*">
                        </div>

                        <div class="form-block">
                            <label for="country/state">Country</label>
                            <input type="text" id="country/state" value="State / Country">
                        </div>

                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="email" id="email" required>
                        </div>

                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input type="text" id="phone" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Order notes</label>
                            <textarea id="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head">
                                <h5>Your Order</h5>
                            </div>
                            <div class="your-order-body">
                                <div class="your-order-item">
                                    <div>
                                        @if (Session::has('cart'))
                                            @php
                                                $carts = Session::get('cart')->items;
                                                $i = 1;
                                                
                                            @endphp
                                            @foreach ($carts as $key => $item)
                                                @php
                                                    $money = 0;
                                                    if ($item['item']->promotion_price == 0) {
                                                        $money = $item['item']->unit_price * $item['qty'];
                                                    } else {
                                                        $money = $item['item']->promotion_price * $item['qty'];
                                                    }
                                                @endphp
                                                <!--  one item	 -->
                                                <div class="media">
                                                    <img width="100px" height="100px"
                                                        src="{{ asset('uploads' . '\\' . $item['item']['image']) }}"
                                                        alt="" class="pull-left">
                                                    <div class="media-body">
                                                        <p class="font-large">{{ $item['item']->name }}</p>
                                                        @if ($item['item']->promotion_price == 0)
                                                            <span class="color-gray your-order-info">Giá:
                                                                ${{ number_format($item['item']->unit_price, 0, ',', '.') }}</span>
                                                        @else
                                                            <span class="color-gray your-order-info">Giá:
                                                                ${{ number_format($item['item']->promotion_price, 0, ',', '.') }}</span>
                                                        @endif
                                                        <span class="color-gray your-order-info">SL:
                                                            {{ $item['qty'] }}</span>
                                                        <span class="color-gray your-order-info">Thành
                                                            tiền: ${{ number_format($money, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- end one item -->
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left">
                                        <p class="your-order-f18">Total:</p>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="color-black">
                                            ${{ number_format(Session::get('cart')->totalPrice, 0, ',', '.') }}</h5>
                                    </div>
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="btn-action">
                                <div class="text-center"><a class="btn btn-success"
                                        href="{{ route('homes.orderdetail') }}">Quay
                                        lại <i class="fa fa-chevron-left"></i></a></div>
                                <div class="text-center"><a class="btn btn-primary" href="#">Đặt hàng <i
                                            class="fa fa-chevron-right"></i></a></div>
                            </div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div>
    <style>
        .btn-action {
            display: flex;
            gap: 10px;
            justify-content: center
        }
    </style>
@endsection
