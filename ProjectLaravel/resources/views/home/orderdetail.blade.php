@extends('home.homelayout')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Giỏ hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{ route('homes.index') }}">Trang chủ</a> / <span>Giỏ hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <div class="table-responsive">
                <!-- Shop Products Table -->
                <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-name">Sản phẩm</th>
                            <th class="product-price">Ảnh sản phẩm</th>
                            <th class="product-status">Đơn giá($)</th>
                            <th class="product-quantity">Số lượng</th>
                            <th class="product-subtotal">Thành tiền($)</th>
                            <th class="product-remove">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (Session::has('cart'))
                            @php
                                $carts = Session::get('cart')->items;
                                // dd($carts);
                            @endphp @foreach ($carts as $key => $item)
                                <tr class="cart_item">
                                    <td class="product-name">
                                        {{ $item['item']['name'] }}
                                    </td>

                                    <td class="product-price"><img width="100px" height="100px"
                                            src="{{ asset('uploads' . '\\' . $item['item']['image']) }}"></td>
                                    @if ($item['item']['promotion_price'] != 0)
                                        <td class="product-status" id="price">
                                            {{ number_format($item['item']['promotion_price'], 0, ',', '.') }}
                                        </td>
                                    @else
                                        <td class="product-status" id="price">
                                            {{ $item['item']['unit_price'] }}
                                        </td>
                                    @endif

                                    <td class="product-quantity">
                                        {{-- <select name="product-qty" id="product-qty" onchange="updateTotalPay()"> --}}
                                        <input value="{{ $item['qty'] }}" type="number" class="ip-number">

                                        {{-- </select> --}}
                                    </td>

                                    <td class="product-subtotal" id="totalPrice">
                                        {{ number_format($item['price'], 0, ',', '.') }}
                                    </td>

                                    <td class="product-remove">
                                        <a href="{{ route('homes.deletefromcart', $key) }}" class="remove"
                                            title="Remove this item"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>Tổng</th>
                                <th></th>
                                <th></th>
                                <th>{{ Session::get('cart')->totalQty }}</th>
                                <th>{{ number_format(Session::get('cart')->totalPrice, 0, ',', '.') }}</th>
                                <td><a class="btn btn-danger">Xoá tất cả</a></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6" style="color:red">Giỏ hàng trống</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
                <div style="text-align: center"><a class="btn btn-primary ax">Đặt hàng</a></div>
                <!-- End of Shop Table Products -->
            </div>




        </div> <!-- #content -->
    </div>
    <script>
        function updateTotalPay() {

            var quantity = $("#product-qty").val();
            console.log(quantity);
            var price = $('#price').text().replace('.', '').trim();
            $("#totalPrice").text((quantity * price).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                "."));

        }
    </script>
    <style>
        .ip-number {
            text-align: center;
            width: 100px;
            height: 21px;
        }
    </style>
@endsection
