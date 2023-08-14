@extends('home.homelayout')
@section('content')
    <div class="container">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body" id="error-404">
                                    <table class="table table-bordered table-hover" id="table_category">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">#</th>
                                                <th style="text-align: center">Tên sản phẩm</th>
                                                <th style="text-align: center">Ảnh sản phẩm</th>
                                                <th style="text-align: center">Đơn giá</th>
                                                <th style="text-align: center">Giá khuyến mại</th>
                                                <th style="text-align: center">Số lượng</th>
                                                <th style="text-align: center">Giảm giá</th>
                                                <th style="text-align: center">Thành tiền</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 0;
                                                $i = 0;
                                            @endphp
                                            @if (count($list) !== 0)
                                                @foreach ($list as $key => $item)
                                                    @php
                                                        
                                                        if ($item->promotion_price < $item->unit_price) {
                                                            $count += $item->promotion_price * $item->sq * (1 - $item->number / 100);
                                                        } else {
                                                            $count += $item->unit_price * $item->sq * (1 - $item->number / 100);
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th scope="row" style="text-align: center">
                                                            {{ $i++ }}
                                                        </th>
                                                        <td style="text-align: center">{{ $item->name }}</td>
                                                        <td style="text-align: center"><img width="100px" height="100px"
                                                                src="{{ asset('uploads' . '\\' . $item->image) }}"></td>
                                                        <td style="text-align: center">
                                                            {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                                        <td style="text-align: center">
                                                            {{ number_format($item->promotion_price, 0, ',', '.') }}</td>
                                                        <td style="text-align: center">
                                                            {{ $item->sq }}</td>
                                                        <td style="text-align: center">
                                                            {{ $item->number . '%' }}
                                                        </td>
                                                        @if ($item->promotion_price < $item->unit_price)
                                                            <td style="text-align: center">
                                                                {{ number_format($item->promotion_price * $item->sq * (1 - $item->number / 100), 0, ',', '.') }}
                                                            </td>
                                                        @else
                                                            <td style="text-align: center">
                                                                {{ number_format($item->unit_price * $item->sq, 0, ',', '.') }}
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th style="text-align: center" colspan="8">Tổng:
                                                        {{ number_format($count, 0, ',', '.') . ' VNĐ' }}
                                                    </th>

                                                </tr>
                                            @else
                                                <tr colspan='4' style="color: red">
                                                    <td>Không có dữ liệu</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-header">
                                    <h3 class="card-title col-9"></h3>
                                    <div id="displayPage" class="col-3"></div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
    </div>
@endsection
