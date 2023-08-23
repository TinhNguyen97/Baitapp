@extends('layouts.homelayout')
@section('content')
    <div class="rev-slider">
        <div class="fullwidthbanner-container" style="z-index: 0">
            <div class="fullwidthbanner">
                <div class="bannercontainer">
                    <div class="banner">
                        <ul>
                            @if (count($slides) !== 0)
                                @foreach ($slides as $item)
                                    <!-- THE FIRST SLIDE -->
                                    <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                        style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                        <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                            data-zoomstart="undefined" data-zoomend="undefined"
                                            data-rotationstart="undefined" data-rotationend="undefined"
                                            data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined"
                                            data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined"
                                            data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                            <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                                data-bgposition="center center" data-bgrepeat="no-repeat"
                                                data-lazydone="undefined" src="{{ asset('uploads/' . $item->image) }}"
                                                data-src="{{ asset('uploads/' . $item->image) }}"
                                                style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('{{ asset('uploads/' . $item->image) }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="tp-bannertimer"></div>
            </div>
        </div>
        <!--slider-->
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @if (count($newProducts) !== 0)
                                    @foreach ($newProducts as $item)
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
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm bán chạy</h4>
                            <div class="beta-products-details">

                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @if (count($topSaleProducts) !== 0)
                                    @foreach ($topSaleProducts as $key => $item)
                                        <div class="col-sm-3">
                                            <div class="single-item">
                                                <div class="ribbon-wrapper">
                                                    <?php
                                                    $upT = number_format($item->unit_price, 0, ',', '.');
                                                    $ppT = number_format($item->promotion_price, 0, ',', '.');
                                                    ?>
                                                    @if ($upT > $ppT)
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
                                                        @if ($upT > $ppT)
                                                            <span class="flash-del">{{ $upT . ' VNĐ' }}</span>
                                                            <span class="flash-sale">{{ $ppT . ' VNĐ' }}</span>
                                                        @else
                                                            <span class="flash-sale"
                                                                style="color: black">{{ $ppT . ' VNĐ' }}</span>
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
                                            </div>
                                        </div>


                                        @if ($key == 3)
                                            <div class="space40">&nbsp;</div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->
    @if (session()->has('addsuccess') && session()->get('addsuccess'))
        <script>
            $(function() {
                alertSuccess('Thêm vào giỏ hàng thành công.')
            })
        </script>
    @endif
    @if (session()->has('delsuccess') && session()->get('delsuccess'))
        <script>
            $(function() {
                alertSuccess('Sản phẩm đã được xóa khỏi giỏ hàng.')
            })
        </script>
    @endif

    @if (session()->has('delallsuccess') && session()->get('delallsuccess'))
        <script>
            $(function() {
                alertSuccess('Tất cả sản phẩm đã được xóa khỏi giỏ hàng.')
            })
        </script>
    @endif

@endsection
