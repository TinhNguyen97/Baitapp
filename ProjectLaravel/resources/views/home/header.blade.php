<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 58 Tràng An, thành phố Ninh Bình</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0981 240 297</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (Auth::check())
                        <li><a class="text-wellcome">
                                Xin chào {{ Auth::user()->full_name }}!
                            </a></li>
                        <li><a href="{{ route('homes.profile') }}"><i class="fa fa-user"></i>Tài
                                khoản</a></li>
                        <li><a href="{{ route('homes.changepassword') }}"><i class="fa fa-key"></i>Đổi mật
                                khẩu</a></li>
                        <li><a href="{{ route('homes.logout') }}"><i class="fa fa-circle"></i>Đăng
                                xuất</a></li>
                    @else
                        <li><a href="{{ route('homes.register') }}">Đăng kí</a></li>
                        <li><a href="{{ route('homes.login') }}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{ route('homes.index') }}" id="logo"><img
                        src="{{ asset('assets/dest/images/logo-cake.png') }}" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{ route('homes.search') }}">
                        <input type="text" value="" name="key" id="s"
                            placeholder="Nhập tên sản phẩm / giá tiền" />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">

                    <div class="cart">
                        <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng(
                            @if (Session::has('cart'))
                                {{ Session::get('cart')->totalQty }}
                            @else
                                Trống
                            @endif) <i class="fa fa-chevron-down"></i>
                        </div>
                        @if (Session::has('cart'))
                            <div class="beta-dropdown cart-body">

                                <?php
                                $total_price = number_format(Session::get('cart')->totalPrice, 0, ',', '.');
                                ?>

                                @foreach ($product_cart as $product)
                                    <?php
                                    $unitPrice = preg_replace('/[.,]/', '', $product['item']['unit_price']);
                                    $promotionPrice = preg_replace('/[.,]/', '', $product['item']['promotion_price']);
                                    $up = remove_special_character($unitPrice);
                                    $pm = remove_special_character($promotionPrice);
                                    ?>
                                    <div class="cart-item">
                                        <a href="{{ route('homes.deletefromcart', $product['item']['id']) }}"
                                            class="cart-item-delete"><i class="fa fa-times"></i></a>
                                        <div class="media">
                                            <a class="pull-left" href="#"><img
                                                    src="{{ asset('uploads/' . $product['item']['image']) }}"
                                                    alt=""></a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                                <span class="cart-item-amount">{{ $product['qty'] }}*<span>

                                                        @if ($pm < $up)
                                                            {{ $pm }}
                                                        @else
                                                            {{ $up }}
                                                        @endif
                                                    </span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span
                                            class="cart-total-value">${{ $total_price }}</span>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{ route('homes.deleteallcart') }}"
                                            style="background-color: rgb(226, 196, 198)"
                                            class="beta-btn primary text-center">Xóa hết<i
                                                class="fa fa-chevron-right"></i></a>
                                        <a href="{{ route('homes.order') }}" class="beta-btn primary text-center">Đặt
                                            hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- .cart -->
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span
                    class='beta-menu-toggle-text'>Menu</span>
                <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{ route('homes.index') }}">Trang chủ</a></li>
                    <li><a href="#">Loại sản phẩm</a>
                        <ul class="sub-menu">
                            @if (count($allTypes) !== 0)
                                @foreach ($allTypes as $item)
                                    <li><a href="{{ route('homes.typesearch', $item->id) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </li>
                    <li><a href="{{ route('homes.about') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('homes.contact') }}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div>
<style>
    .text-wellcome {
        width: 14rem !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
