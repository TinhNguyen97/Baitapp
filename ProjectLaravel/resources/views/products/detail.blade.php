@extends('home.homelayout')
@section('content')
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9 zd0">

                    <div class="row">
                        <div class="col-sm-4">
                            <?php
                            $up = '$' . number_format($product->unit_price, 0, ',', '.');
                            $pp = '$' . number_format($product->promotion_price, 0, ',', '.');
                            ?>

                            <img width="270" height="320" src="{{ asset('uploads' . '\\' . $product->image) }}"
                                alt="">
                            @if ($up > $pp)
                                <div class="ribbon-wrapper sps">
                                    <div class="ribbon sale">Sale</div>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title">
                                <h3>{{ $product->name }}</h3>
                                </p>
                            </div>
                            <div class="single-item-body">
                                <p class="single-item-price">
                                    @if ($up > $pp)
                                        <span class="flash-del">{{ $up }}</span>
                                        <span class="flash-sale">{{ $pp }}</span>
                                    @else
                                        <span class="flash-sale" style="color: black">{{ $product->unit_price }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="space20">&nbsp;</div>

                            <p>Số lượng:</p>
                            <div class="single-item-options">
                                <select class="wc-select" name="color">
                                    <option>Số lượng</option>
                                    @for ($i = 1; $i < 6; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Mô tả</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{ $product->description }}</p>

                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản phẩm liên quan</h4>
                        <p style="color: blue">Tìm thấy {{ count($allProducts) }} sản phẩm</p>
                        <div class="row">
                            @foreach ($relativeProducts as $item)
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        <div class="ribbon-wrapper">
                                            <?php
                                            $up = number_format($item->unit_price, 0, ',', '.');
                                            $pp = number_format($item->promotion_price, 0, ',', '.');
                                            ?>
                                            @if ($up > $pp)
                                                <div class="ribbon sale">Sale</div>
                                            @endif
                                        </div>

                                        <div class="single-item-header">
                                            <a href="#"><img width="270" height="320"
                                                    src="{{ asset('uploads/' . $item->image) }}" alt=""></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $item->name }}</p>
                                            <p class="single-item-price">
                                                @if ($up > $pp)
                                                    <span class="flash-del">{{ '$' . $up }}</span>
                                                    <span class="flash-sale">{{ '$' . $pp }}</span>
                                                @else
                                                    <span class="flash-sale"
                                                        style="color: black">{{ '$' . $pp }}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="#"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary"
                                                href="{{ route('homes.detail', $item->id) }}">Details <i
                                                    class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                    <div class="pagination">
                        {{ $relativeProducts->links() }}
                    </div>
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Best Sellers</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/1.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/2.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/3.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/4.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">New Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/1.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/2.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/3.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="product.html"><img
                                            src="assets/dest/images/products/sales/4.png" alt=""></a>
                                    <div class="media-body">
                                        Sample Woman Top
                                        <span class="beta-sales-price">$34.55</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
    <style>
        .sps {
            bottom: 266px;
            right: 12px;
        }

        .zd0 {
            z-index: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }
    </style>
@endsection
