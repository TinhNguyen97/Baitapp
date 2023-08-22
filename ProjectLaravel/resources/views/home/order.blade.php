@extends('layouts.homelayout')
@section('content')
    <div>
        <div class="inner-header">
            <div class="container">
                <div class="pull-left">
                    <h6 class="inner-title">Đặt hàng</h6>
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
            <div class="container" id="content">

                <form action="{{ route('homes.handleorder') }}" method="post" class="beta-form-checkout">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Thông tin người nhận</h4>
                            <div class="space20">&nbsp;</div>

                            <div>
                                <label for="your_first_name">Họ và tên*</label>
                                <input type="text" name="name">
                            </div>
                            @error('name')
                                <span style="color:red">{{ $message }}</span>
                            @enderror

                            <div>
                                <label for="address">Địa chỉ*</label>
                                <input type="text" id="address" name="address">
                            </div>
                            @error('address')
                                <span style="color:red">{{ $message }}</span>
                            @enderror


                            <div>
                                <label for="email">Email*</label>
                                <input type="email" id="email" name="email">
                            </div>
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror

                            <div>
                                <label for="phone">SĐT*</label>
                                <input type="text" id="phone" name="phone">
                            </div>
                            @error('phone')
                                <span style="color:red">{{ $message }}</span>
                            @enderror

                            <div class="text-note">
                                <label for="notes">Ghi chú</label>
                                <textarea id="notes" name="note"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="your-order">
                                <div class="your-order-head">
                                    <h5>Hóa đơn</h5>
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
                                                                    {{ number_format($item['item']->unit_price, 0, ',', '.') . ' VNĐ' }}</span>
                                                            @else
                                                                <span class="color-gray your-order-info">Giá:
                                                                    {{ number_format($item['item']->promotion_price, 0, ',', '.') . ' VNĐ' }}</span>
                                                            @endif
                                                            <span class="color-gray your-order-info">SL:
                                                                {{ $item['qty'] }}</span>
                                                            @if (Session::has('coupon'))
                                                                @php
                                                                    $totalAfterCoupon = $money * (1 - Session::get('coupon')['number'] / 100);
                                                                    
                                                                @endphp
                                                                <span class="color-gray your-order-info">Giảm giá:
                                                                    {{ Session::get('coupon')['number'] . '%' }}</span>
                                                                <span class="color-gray your-order-info">Thành
                                                                    tiền:
                                                                    {{ number_format($totalAfterCoupon, 0, ',', '.') . ' VNĐ' }}</span>
                                                            @else
                                                                <span class="color-gray your-order-info">Thành
                                                                    tiền:
                                                                    {{ number_format($money, 0, ',', '.') . ' VNĐ' }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <!-- end one item -->
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="your-order-item">
                                        <div class="pull-left">
                                            <p class="your-order-f18">Tổng:</p>
                                        </div>
                                        <div class="pull-right">
                                            @if (Session::has('coupon'))
                                                <h5 class="color-black">
                                                    {{ number_format(Session::get('cart')->totalPrice * (1 - Session::get('coupon')['number'] / 100), 0, ',', '.') . ' VNĐ' }}
                                                </h5>
                                            @else
                                                <h5 class="color-black">
                                                    {{ number_format(Session::get('cart')->totalPrice, 0, ',', '.') . ' VNĐ' }}
                                                </h5>

                                        </div>
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>


                            </div> <!-- .your-order -->

                            <div class="btn-action">

                                <div class="text-center"><a class="btn btn-success"
                                        href="{{ route('homes.orderdetail') }}">Quay
                                        lại <i class="fa fa-chevron-left"></i></a></div>
                                <div class="text-center"><button class="btn btn-primary" type="submit">Đặt hàng <i
                                            class="fa fa-chevron-right"></i></button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .btn-action {
            display: flex;
            gap: 6px;
            justify-content: center;
            margin-top: 12%;
        }

        .text-note {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection
