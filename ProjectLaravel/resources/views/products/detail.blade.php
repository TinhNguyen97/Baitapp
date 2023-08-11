@extends('home.homelayout')
@section('content')
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9 zd0">

                    <div class="row">
                        <div class="col-sm-4">
                            <?php
                            $up = number_format($product->unit_price, 0, ',', '.') . ' VNĐ';
                            $pp = number_format($product->promotion_price, 0, ',', '.') . ' VNĐ';
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
                                        <span class="flash-sale" style="color: black">{{ $up }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="space20">&nbsp;</div>

                            <div class="single-item-options">
                                <a class="add-to-cart" href="{{ route('homes.addtocart', $product->id) }}"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <p>Mô tả</p>

                        <div class="panel" id="tab-description">
                            <p>{{ $product->description }}</p>

                        </div>
                        <p>Bình luận</p>
                        @if (count($comments) != 0)
                            @foreach ($comments as $item)
                                <div style="margin-left:25px"><span style="font-weight:bold">{{ $item['full_name'] }}
                                    </span><span style="font-style: italic;">{{ $item->content }}</span>
                                </div>
                            @endforeach
                        @else
                            <p style="color:red">Không có bình luận</p>
                        @endif


                        <form action="{{ route('homes.comment', $product->id) }}" method="POST">
                            <textarea name="content" id="" style="border:2px solid #f6f6f6; height:20vh"
                                placeholder="Viết bình luận của bạn..."></textarea>
                            <button class="btn btn-primary" type="submit">Gửi bình luận</button>
                        </form>
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
                                            <a href="{{ route('homes.detail', $item->id) }}"><img width="270"
                                                    height="320" src="{{ asset('uploads/' . $item->image) }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $item->name }}</p>
                                            <p class="single-item-price">
                                                @if ($up > $pp)
                                                    <span class="flash-del">{{ $up . ' VNĐ' }}</span>
                                                    <span class="flash-sale">{{ $pp . ' VNĐ' }}</span>
                                                @else
                                                    <span class="flash-sale"
                                                        style="color: black">{{ $pp . ' VNĐ' }}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left"
                                                href="{{ route('homes.addtocart', $item->id) }}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{ route('homes.detail', $item->id) }}">Chi
                                                tiết <i class="fa fa-chevron-right"></i></a>
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
                    <img height="500px" src="{{ asset('uploads/Banh-Macaron-Phap-1.1.jpg') }}">
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
