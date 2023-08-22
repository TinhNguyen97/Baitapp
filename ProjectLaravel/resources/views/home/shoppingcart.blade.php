@extends('layouts.homelayout')
@section('content')
    @php
        if (Session::has('cart')) {
            $products = Session::get('cart');
            $items = $products->items;
        }
    @endphp
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Shopping Cart</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{ route('homes.index') }}">Home</a> / <span>Shopping Cart</span>
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
                            <th>Ảnh</th>
                            <th class="product-price">Giá</th>
                            <th class="product-quantity">Số lượng</th>
                            <th class="product-subtotal">Thành tiền</th>
                            <th class="product-remove">Xóa</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products)
                            @foreach ($items as $item)
                                <tr>
                                    <td>$item->items</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">Giỏ hàng trống</td>
                            </tr>
                        @endif

                        <tr>
                            <th>Tổng</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-primary">Đặt hàng</button></td>
                        </tr>
                    </tbody>

                </table>
                <!-- End of Shop Table Products -->
            </div>


            <!-- End of Cart Collaterals -->
            <div class="clearfix"></div>

        </div>
    </div>
@endsection
