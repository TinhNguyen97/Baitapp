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
                <form action="{{ route('orders.search') }}" method="get">
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

                                        <th colspan="3" style="text-align: center">
                                            Hành động
                                        </th>
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
                                                <td style="text-align: center"><a
                                                        href="{{ route('orders.orderdetails', $item->id) }}"><i
                                                            class="fa-solid fa-eye"></i></a></td>
                                                <td style="text-align: center"><a
                                                        href="{{ route('orders.handleapprove', $item->id) }}"><i
                                                            class="fa-sharp fa-solid fa-check"></i></a></td>
                                                <td style="text-align: center"><a
                                                        href="{{ route('orders.handlecancel', $item->id) }}"><i
                                                            class="fa-solid fa-xmark"></i></a></td>
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
    @if (session()->has('successApprove') && session()->get('successApprove'))
        <script>
            $(function() {
                alertSuccess('Đơn hàng đã được gửi đi,mail đã được gửi tới khách hàng!')
            })
        </script>
    @endif
    @if (session()->has('successCancel') && session()->get('successCancel'))
        <script>
            $(function() {
                alertSuccess('Đơn hàng đã bị hủy, mail đã được gửi tới khách hàng!')
            })
        </script>
    @endif
    <style>
        .main-footer {
            margin-left: 0px !important;
        }

        .pagination {
            display: flex;
            justify-content: center;
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
