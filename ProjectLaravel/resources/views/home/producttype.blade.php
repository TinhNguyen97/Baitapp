@extends('home.homelayout')
@section('content')
    <div class="container">
        <div>
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Danh mục {{ $type }}</h4>
                            <p style="color: blue">Tìm thấy {{ count($allProducts) }} sản phẩm</p>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @if (count($allProductSearch) !== 0)
                                    @foreach ($allProductSearch as $key => $item)
                                        <div class="col-sm-3">
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
                                                    <a class="beta-btn primary"
                                                        href="{{ route('homes.detail', $item->id) }}">Chi tiết <i
                                                            class="fa fa-chevron-right"></i></a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                @if ($key !== 7)
                                                    <div class="space50">&nbsp;</div>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h5 style="color: red">Không có sản phẩm cần tìm</h5>
                                @endif
                            </div>
                        </div> <!-- .beta-products-list -->



                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
    <div class="pagination">
        {{ $allProductSearch->appends($request->all())->links() }}
    </div>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
        }

        .ribbon {
            z-index: 1;
        }
    </style>
@endsection
