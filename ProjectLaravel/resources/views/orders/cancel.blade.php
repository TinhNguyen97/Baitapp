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
                    <div class="col-sm-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập email hoặc số điện thoại" name="key"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary search"type="submit">
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
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Email</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Số điện thoại</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ghi chú</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Trạng thái</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ngày tạo</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ngày cập nhật</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($orders) !== 0)
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->name }}</td>
                                                <td style="text-align: center">{{ $item->address }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->email }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->phone }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->note }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->status }} </td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->created_at }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->updated_at }}</td>

                                            </tr>
                                        @endforeach
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
        <div class="pagination">
            {{ $orders->links() }}
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

        .search {
            margin-left: 0.2vw;
        }

        .main-footer {
            margin-left: 250px !important;
        }
    </style>
    <script>
        function alertSuccess(message) {
            swal(message, "", "success", {
                button: "OK!",
            })
        }
    </script>
@endsection
