@extends('admin.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Quản lý người dùng</h1>
                    </div>

                </div>
                <form action="{{ route('users.search') }}" method="get">
                    <div class="col-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập tên hoặc địa chỉ email" name="key"
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
                            <h1 class="card-title col-11 abc">Người dùng</h1>

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
                                        <th style="text-align: center">Ngày tạo</th>
                                        <th style="text-align: center">Trạng thái</th>
                                        <th colspan="2" style="text-align: center">
                                            Hành động
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($users) !== 0)
                                        @foreach ($users as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->full_name }}</td>
                                                <td style="text-align: center">{{ $item->address }}</td>
                                                <td style="text-align: center">{{ $item->email }}</td>
                                                <td style="text-align: center">{{ $item->phone }}</td>
                                                {{-- <td style="text-align: center"> {{ $item->status }} </td> --}}
                                                <td style="text-align: center">{{ $item->created_at }}</td>
                                                @if ($item->is_active)
                                                    <td style="text-align: center">Đã kích hoạt</td>
                                                    <td style="text-align: center"><a class="btn btn-primary"
                                                            href="{{ route('users.handleactive', $item->id) }}"><i
                                                                class="fa-solid fa-lock-open"></i></a></td>
                                                @else
                                                    <td style="text-align: center">Đã khóa</td>
                                                    <td style="text-align: center"><a class="btn btn-primary"
                                                            href="{{ route('users.handleactive', $item->id) }}"><i
                                                                class="fa fa-lock"></i></a></td>
                                                @endif
                                                <td style="text-align: center"><button class="btn btn-danger"
                                                        data-target="#delete-user" data-toggle="modal" type="button"
                                                        onclick="deleteUser({{ $item->id }})"><i
                                                            class="fa fa-trash"></i></button></td>
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
            {{ $users->links() }}
        </div>
        <!-- /.container-fluid -->
    </section>
    <form method="post">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="delete-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa tài khoản</h4>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa không?</p>
                    </div>

                    <div class="modal-footer justify-content-between" id="delete-category-button">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Đóng</button>
                        <button class="btn btn-danger" class="close">Xóa</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    @if (session()->has('locksuccess') && session()->get('locksuccess'))
        <script>
            var email = '{{ session()->get('email') }}';

            $(function() {
                alertSuccess('Đã khóa tài khoản ' + email)
            })
        </script>
    @endif
    @if (session()->has('unlocksuccess') && session()->get('unlocksuccess'))
        <script>
            var email = '{{ session()->get('email') }}';
            $(function() {
                alertSuccess('Đã mở tài khoản ' + email);
            })
        </script>
    @endif
    @if (session()->has('isDeleteSuccess') && session()->get('isDeleteSuccess'))
        <script>
            $(function() {
                alertSuccess('Đã xóa tài khoản!');
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
        function routeDelete(id) {
            return "{{ route('users.handledelete', 0) }}".replace(/\d$/, id);
        }

        function alertSuccess(message) {
            swal(message, "", "success", {
                button: "OK!",
            })
        }

        function deleteUser(id) {
            $('#delete-user').parents('form').attr('action', routeDelete(id))
        }
    </script>
@endsection
