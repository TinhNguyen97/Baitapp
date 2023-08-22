@extends('layouts.adminlayout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/vieworderdetail.css.css') }}">

    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title col-11 abc">Đơn hàng</h1>
                                <a class="btn btn-primary col-1" href="{{ route('orders.index') }}">
                                    Quay lại
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="error-404">
                                <table class="table table-bordered table-hover" id="table_category">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">Tên sản phẩm</th>
                                            <th style="text-align: center">Ảnh sản phẩm</th>
                                            <th style="text-align: center">Đơn giá(VNĐ)</th>
                                            <th style="text-align: center">Giá khuyến mại(VNĐ)</th>
                                            <th style="text-align: center">Số lượng</th>
                                            <th style="text-align: center">Thành tiền(VNĐ)</th>
                                            <th style="text-align: center">Giảm giá</th>
                                            <th style="text-align: center">Tiền sau giảm giá(VNĐ)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @if (count($details) !== 0)
                                            @foreach ($details as $key => $item)
                                                @php
                                                    
                                                    if ($item->promotion_price < $item->unit_price) {
                                                        $count += $item->promotion_price * $item->quantity * (1 - $item->number / 100);
                                                    } else {
                                                        $count += $item->unit_price * $item->quantity * (1 - $item->number / 100);
                                                    }
                                                @endphp
                                                <tr>
                                                    <th scope="row" style="text-align: center">
                                                        {{ $loop->iteration + ($details->currentPage() - 1) * $details->perPage() }}
                                                    </th>
                                                    <td style="text-align: center">{{ $item->name }}</td>
                                                    <td style="text-align: center"><img width="100px" height="100px"
                                                            src="{{ asset('uploads' . '\\' . $item->image) }}"></td>
                                                    <td style="text-align: center">{{ formatMoney($item->unit_price) }}</td>
                                                    <td style="text-align: center">{{ formatMoney($item->promotion_price) }}
                                                    </td>
                                                    <td style="text-align: center">
                                                        {{ $item->quantity }}</td>
                                                    @if ($item->promotion_price < $item->unit_price)
                                                        <td style="text-align: center">
                                                            {{ formatMoney($item->promotion_price * $item->quantity) }}
                                                        </td>
                                                        @if ($item->number == 0)
                                                            <td style="text-align: center">Không áp dụng</td>
                                                        @else
                                                            <td style="text-align: center">{{ $item->number . '%' }}</td>
                                                        @endif
                                                        <td style="text-align: center">
                                                            {{ formatMoney($item->promotion_price * $item->quantity * (1 - $item->number / 100)) }}
                                                        </td>
                                                    @else
                                                        <td style="text-align: center">
                                                            {{ formatMoney($item->unit_price * $item->quantity) }} </td>
                                                        <td style="text-align: center">{{ $item->number . '%' }}</td>
                                                        <td style="text-align: center">
                                                            {{ formatMoney($item->unit_price * $item->quantity * (1 - $item->number / 100)) }}
                                                        </td>
                                                    @endif



                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th style="text-align: center" colspan="9">Tổng:
                                                    {{ formatMoney($count) . ' VNĐ' }}
                                                </th>

                                            </tr>
                                        @else
                                            <tr colspan='4'>
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
            <div class="pagination">
                {{ $details->links() }}
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>


@endsection
