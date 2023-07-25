@extends('admin.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Quản lý đơn hàng</h1>
                    </div>

                </div>
                <form action="{{ route('products.search') }}" method="get">
                    <div class="col-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm/giá tiền" name="key"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary col-2 search"type="submit">
                            Tìm kiếm
                        </button>
                </form>
            </div>
    </div>

    </section>

    <!-- Main content -->
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
                                        <th style="text-align: center">Đơn giá</th>
                                        <th style="text-align: center">Giá khuyến mại</th>
                                        <th style="text-align: center">Số lượng</th>
                                        <th style="text-align: center">Thành tiền</th>
                                        <th style="text-align: center">Ngày tạo</th>

                                        <th colspan="2" style="text-align: center">
                                            Duyệt đơn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) !== 0)
                                        @foreach ($details as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($details->currentPage() - 1) * $details->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->name }}</td>
                                                <td style="text-align: center"><img width="100px" height="100px"
                                                        src="{{ asset('uploads' . '\\' . $item->image) }}"></td>
                                                <td style="text-align: center">{{ $item->unit_price }}</td>
                                                <td style="text-align: center">{{ $item->promotion_price }}</td>
                                                <td style="text-align: center">{{ $item->quantity }}</td>
                                                @if ($item->promotion_price < $item->unit_price)
                                                    <td style="text-align: center">
                                                        {{ $item->promotion_price * $item->quantity }} </td>
                                                @else
                                                    <td style="text-align: center">
                                                        {{ $item->unit_price * $item->quantity }}
                                                    </td>
                                                @endif
                                                <td style="text-align: center">{{ $item->created_at }}</td>
                                                <td style="text-align: center"><a href=""><i
                                                            class="fa-sharp fa-solid fa-check"></i></a></td>
                                                <td style="text-align: center"><a href=""><i
                                                            class="fa-solid fa-xmark"></i></a></td>
                                            </tr>
                                        @endforeach
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
    <style>
        .main-footer {
            margin-left: 0px !important;
        }
    </style>

@endsection
