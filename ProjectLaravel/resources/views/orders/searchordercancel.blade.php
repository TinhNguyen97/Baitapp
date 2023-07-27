@extends('admin.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Đơn hàng đã hủy</h1>
                    </div>

                </div>
                <form action="{{ route('orders.searchordercancel') }}" method="get">
                    <div class="col-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập email hoặc số điện thoại" name="key"
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="{{ $request->key ? $request->key : '' }}">
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="error-404">
                            <table class="table table-bordered table-hover" id="table_category">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Tên</th>
                                        <th style="text-align: center">Địa chỉ</th>
                                        <th style="text-align: center">Email</th>
                                        <th style="text-align: center">Số điện thoại</th>
                                        <th style="text-align: center">Ghi chú</th>
                                        <th style="text-align: center">Trạng thái</th>
                                        <th style="text-align: center">Ngày tạo</th>
                                        <th style="text-align: center">Ngày cập nhật</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($allOrders) !== 0)
                                        @foreach ($allOrders as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($allOrders->currentPage() - 1) * $allOrders->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->name }}</td>
                                                <td style="text-align: center">{{ $item->address }}</td>
                                                <td style="text-align: center">{{ $item->email }}</td>
                                                <td style="text-align: center">{{ $item->phone }}</td>
                                                <td style="text-align: center">{{ $item->note }}</td>
                                                <td style="text-align: center"> {{ $item->status }} </td>
                                                <td style="text-align: center">{{ $item->created_at }}</td>
                                                <td style="text-align: center">{{ $item->updated_at }}</td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr colspan='4'>
                                            <td style="color: red">Không có dữ liệu</td>
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
            {{ $allOrders->links() }}
        </div>
        <!-- /.container-fluid -->
    </section>
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
