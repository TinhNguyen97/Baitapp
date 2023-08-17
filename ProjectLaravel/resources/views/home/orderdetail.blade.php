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
    @if (Session::has('cart'))
        <div class="container">
            <form action="{{ route('coupons.checkCoupon') }}">
                <div class="css-coupon">
                    <div><input type="text" name="code" placeholder="Nhập mã khuyến mại"></div>
                    <div><button class="btn btn-primary" type="submit">Áp dụng</button></div>
                    <a href="{{ route('coupons.delCoupon') }}" class="btn btn-danger">Loại bỏ</a>
                    <div style="font-style:italic; font-size:13px; color:blue">
                        <p>(Lưu ý: Mỗi đơn hàng chỉ áp dụng được 1 mã khuyến mãi.)</p>
                    </div>
                </div>
            </form>
        </div>
    @endif
    @if (Session::has('outtime'))
        <div class="container">
            <div class="alert alert-danger">{{ Session::get('outtime') }}</div>
        </div>
    @endif
    @if (Session::has('delsuccess'))
        <div class="container">
            <div class="alert alert-success">{{ Session::get('delsuccess') }}</div>
        </div>
    @endif
    @if (Session::has('duplicate'))
        <div class="container">
            <div class="alert alert-success">{{ Session::get('duplicate') }}</div>
        </div>
    @endif
    @if (Session::has('message'))
        <div class="container">
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="container">
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        </div>
    @endif
    @if (Session::has('out'))
        <div class="container">
            <div class="alert alert-danger">{{ Session::get('out') }}</div>
        </div>
    @endif
    <div class="container">
        <div id="content">
            @if (Session::has('cart'))
                <div style="text-align:right;margin-bottom:24px"><a class="btn btn-danger"
                        href="{{ route('homes.deleteallcart') }}">Xóa
                        tất cả<i class="fa fa-chevron-right"></i></a></div>
            @endif
            @if (Session::has('overquantity'))
                <div class="alert alert-danger">{!! Session::get('overquantity') !!}</div>
            @endif
            <div class="table-responsive">
                <!-- Shop Products Table -->
                <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th class="product-name">Sản phẩm</th>
                            <th class="product-price">Ảnh sản phẩm</th>
                            <th class="product-status">Đơn giá</th>
                            <th class="product-quantity">Số lượng</th>
                            <th class="product-subtotal" style="width:20%">Thành tiền</th>
                            <th class="product-remove">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (Session::has('cart'))
                            @php
                                $carts = Session::get('cart')->items;
                                $i = 1;
                                // dd($carts);
                            @endphp
                            @foreach ($carts as $key => $item)
                                {{-- @dd($item) --}}

                                <tr class="cart_item">
                                    <td>{{ $i++ }}</td>
                                    <td class="product-name">
                                        {{ $item['item']['name'] }}
                                    </td>

                                    <td class="product-price"><img width="100px" height="100px"
                                            src="{{ asset('uploads' . '\\' . $item['item']['image']) }}"></td>
                                    @if ($item['item']['promotion_price'] != 0)
                                        <td class="product-status" id="price">
                                            {{ number_format($item['item']['promotion_price'], 0, ',', '.') }}
                                        </td>
                                        <td class="product-quantity">
                                            <input value="{{ $item['qty'] }}" class="product-qty ip-number" min="1"
                                                oninput="updateTotalPay.call(this, {{ $key }})" id="qty"
                                                type="text" name="quantity"
                                                data-price="{{ $item['item']['promotion_price'] }}">
                                        </td>
                                        <td class="product-subtotal">
                                            {{ number_format($item['item']['promotion_price'] * $item['qty'], 0, ',', '.') }}
                                        </td>
                                    @else
                                        <td class="product-status" id="price">
                                            {{ $item['item']['unit_price'] }}
                                        </td>
                                        <td class="product-quantity">
                                            <input value="{{ $item['qty'] }}" class="product-qty ip-number" min="1"
                                                oninput="updateTotalPay.call(this, {{ $key }})" id="qty"
                                                type="text" name="quantity"
                                                data-price="{{ $item['item']['unit_price'] }}">
                                        </td>
                                        <td class="product-subtotal">
                                            {{ number_format($item['item']['unit_price'] * $item['qty'], 0, ',', '.') }}
                                        </td>
                                    @endif

                                    <td class="product-remove">
                                        <a class="btn btn-danger" href="{{ route('homes.deletefromcart', $key) }}"
                                            title="Remove this item">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" style="color:red">Giỏ hàng trống</td>
                            </tr>
                        @endif

                    </tbody>

                </table>

                @if (Session::has('cart'))
                    <table class="shop_table beta-shopping-cart-table">
                        <tr>
                            <thead>
                                <th>Tổng</th>
                                <th colspan="2">
                                    <ul style="text-align:left; font-weight:bold">
                                        <li>Tổng tiền:<span id="total-price">
                                                {{ number_format(Session::get('cart')->totalPrice, 0, ',', '.') . ' VNĐ' }}
                                            </span>
                                        </li>
                                        @if (Session::has('coupon'))
                                            @php
                                                $totalAfterCoupon = Session::get('cart')->totalPrice * (1 - Session::get('coupon')['number'] / 100);
                                                $totalAfterCoupon = number_format($totalAfterCoupon, 0, ',', '.');
                                            @endphp
                                            <li>Mã giảm: <span
                                                    id="coupon">{{ Session::get('coupon')['number'] . '%' }}</span>
                                            </li>
                                            <li>Tổng đã giảm:<span id="total-after-cou">
                                                    {{ $totalAfterCoupon . ' VNĐ' }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </th>
                            </thead>
                            {{-- <tbody>
                            <tr>
                     
                            </tr>
                        </tbody> --}}
                    </table>


                    <div>

                        <div class="text-center"> <a class="btn btn-primary" href="{{ route('homes.order') }}">Thông
                                tin
                                đặt
                                hàng <i class="fa fa-chevron-right"></i></a></div>
                    </div>
                @endif
                <!-- End of Shop Table Products -->


            </div>
        </div>
    </div>

    <script>
        function updateTotalPay(key) {
            var index = this.value.length - 1;
            if (isNaN(Number(this.value[index]))) {
                this.value = this.value?.slice(0, -1);
                // console.log(this.value);
            }
            if (this.value == 0) {
                this.value = 1
            }
            if (this.value[0] == 0 && this.value.length > 1) {
                this.value = this.value?.slice(1);
            }
            // $(this).parents('tr').find('.product-subtotal').text(123)
            // return;
            var totalPrice = 0;
            var totalQty = 0;
            var quantity = $(this).val();
            var oldPrice = $(this).data('price');
            var coupon = $('#coupon').text().replace('%', '');
            $(this).parents('tr').find('.product-subtotal').text(formatNumberWithDot(quantity * oldPrice));
            $(this).parents('tbody').find('.product-subtotal').each((index, item) => {
                totalPrice += Number($(item).text().trim().replaceAll('.', ''));
            });

            $('.product-qty').parents('tbody').find('.product-quantity .product-qty').each((index, item) => {
                totalQty += Number($(item).val().trim().replaceAll('.', ''));
            });

            $('#total-quantity').text(totalQty)
            $('#total-price').text(' ' + formatNumberWithDot(totalPrice) + ' VNĐ')
            $('#total-after-cou').text(' ' + formatNumberWithDot(totalPrice * (1 - coupon / 100)) + ' VNĐ')

            $.ajax({
                url: "{{ route('homes.updatecart', [' a', ' b']) }}".replace('%20a', key).replace('%20b',
                    quantity),
                type: 'POST',
                data: {

                },
                success: function() {
                    // console.log("Data sent!");
                }
            })

        }

        function formatNumberWithDot(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    </script>
    <style>
        .ip-number {
            text-align: center;
            width: 100px;
            height: 35px;
            border: 1px solid #e1e1e1;
        }

        .css-coupon {
            display: flex;
            gap: 5px;
            align-items: center;
        }
    </style>
@endsection
