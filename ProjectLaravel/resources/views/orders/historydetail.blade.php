@extends('admin.adminlayout')
@section('content')


    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title col-11 abc">Đơn hàng</h1>
                                <a class="btn btn-primary col-1" href="{{ route('orders.history') }}">
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
                                            <th class="d-none d-xl-table-cell" style="text-align: center">Đơn giá</th>
                                            <th class="d-none d-xl-table-cell" style="text-align: center">Giá khuyến mại
                                            </th>
                                            <th class="d-none d-xl-table-cell" style="text-align: center">Số lượng</th>
                                            <th class="d-none d-xl-table-cell" style="text-align: center">Thành tiền</th>
                                            <th class="d-none d-xl-table-cell" style="text-align: center">Ngày tạo</th>

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
                                                        $count += $item->promotion_price * $item->quantity;
                                                    } else {
                                                        $count += $item->unit_price * $item->quantity;
                                                    }
                                                @endphp
                                                <tr>
                                                    <th scope="row" style="text-align: center">
                                                        {{ $loop->iteration + ($details->currentPage() - 1) * $details->perPage() }}
                                                    </th>
                                                    <td style="text-align: center">{{ $item->name }}</td>
                                                    <td style="text-align: center"><img width="100px" height="100px"
                                                            src="{{ asset('uploads' . '\\' . $item->image) }}"></td>
                                                    <td class="d-none d-xl-table-cell" style="text-align: center">
                                                        {{ $item->unit_price }}</td>
                                                    <td class="d-none d-xl-table-cell" style="text-align: center">
                                                        {{ $item->promotion_price }}</td>
                                                    <td class="d-none d-xl-table-cell" style="text-align: center">
                                                        {{ $item->quantity }}</td>
                                                    @if ($item->promotion_price < $item->unit_price)
                                                        <td class="d-none d-xl-table-cell" style="text-align: center">
                                                            {{ $item->promotion_price * $item->quantity }} </td>
                                                    @else
                                                        <td class="d-none d-xl-table-cell" style="text-align: center">
                                                            {{ $item->unit_price * $item->quantity }}
                                                        </td>
                                                    @endif
                                                    <td class="d-none d-xl-table-cell" style="text-align: center">
                                                        {{ $item->created_at }}</td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th style="text-align: center" colspan="8">Tổng: {{ $count }}
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
    <style>
        .main-footer {
            margin-left: 0px !important;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }
    </style>

@endsection
