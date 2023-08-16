@extends('admin.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Quản lý coupon</h1>
                    </div>

                </div>
                <form action="{{ route('coupons.search') }}" method="get">
                    <div class="col-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập tên/mã coupon" name="key"
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
                            <h1 class="card-title col-11 abc">Coupon</h1>

                            <button class="btn btn-primary col-1" data-target="#create-products" data-toggle="modal"
                                type="button">
                                Tạo mới
                            </button>
                            <p style="color: blue">Tìm thấy {{ count($coupons) }} coupon!</p>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="error-404">
                            <table class="table table-bordered table-hover" id="table_category">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Tên coupon</th>
                                        <th style="text-align: center">Mã coupon</th>
                                        <th style="text-align: center">Số lượng</th>
                                        <th style="text-align: center">% giảm</th>
                                        <th style="text-align: center">Ngày tạo</th>
                                        <th style="text-align: center">Ngày cập nhật</th>

                                        <th colspan="2" style="text-align: center">
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($allCouponSearch) !== 0)
                                        @foreach ($allCouponSearch as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($allCouponSearch->currentPage() - 1) * $allCouponSearch->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->coupon_name }}</td>
                                                <td style="text-align: center">{{ $item->code }}</td>

                                                <td style="text-align: center">{{ $item->time }}</td>
                                                <td style="text-align: center">{{ $item->number }}</td>

                                                <td style="text-align: center">{{ $item->created_at }}</td>
                                                <td style="text-align: center">{{ $item->updated_at }}</td>
                                                <td style="text-align: center"><button class="btn btn-primary"
                                                        data-target="#edit-category" data-toggle="modal" type="button"
                                                        onclick="showDetail(
                                                            '{{ $item->coupon_name }}',
                                                           {{ $item->id }} ,
                                                           '{{ $item->code }}',
                                                           {{ $item->time }},
                                                           {{ $item->number }}
                                                           )">
                                                        <i class="fa-solid fa-pen-to-square"></i></button></td>
                                                <td style="text-align: center"><button class="btn btn-danger"
                                                        data-target="#delete-category" data-toggle="modal" type="button"
                                                        onclick="deleteDish('{{ $item->code }}')"><i
                                                            class="fa fa-trash"></i></button></td>
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
            {{ $allCouponSearch->links() }}

        </div>
        <!-- /.container-fluid -->
    </section>


    <!-- /.content -->
    </div>
    <form method="post" id="form-edit" enctype="multipart/form-data" action="">
        @csrf
        @method('PUT')
        <input name="id" type="hidden" id="idEdit" />
        <div class="modal fade" id="edit-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh sửa coupon</h4>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên coupon</label>
                            <input class="form-control" id="editName" name="editName" placeholder="Nhập tên coupon"
                                type="text" required />
                        </div>

                        <div class="form-group">
                            <label for="image">Mã coupon</label>
                            <!-- <p id="imageCategory"></p> -->
                            <input class="form-control" id="editCode" name="editCode" placeholder="Nhập mã coupon"
                                type="text" required />
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input id="editTime" class="form-control" placeholder="Nhập số lượng" type="number"
                                name="editTime" min="0" required />
                        </div>
                        <div class="form-group">
                            <label>% giảm</label>
                            <input id="editNumber" class="form-control" placeholder="Nhập % giảm" type="number"
                                name="editNumber" required min="0" />
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between" id="edit-form">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary" type="button" onclick="$('#form-edit').submit()" class="close"
                            name="update">Chỉnh sửa</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    <form action="" method="post" enctype="multipart/form-data" id="create-form">
        <div class="modal fade" id="create-products">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo mới coupon</h4>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">Tên coupon</label>
                            <input name="coupon_name" class="form-control" id="name" placeholder="Nhập tên coupon"
                                type="text" />
                        </div>


                        <div class="form-group">
                            <label for="price">Mã coupon</label>
                            <input class="form-control" id="code" type="text" placeholder="Nhập mã coupon"
                                name="code" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Số lượng</label>
                            <input class="form-control" id="time" type="number" placeholder="Nhập giá"
                                min="0" name="time" required />
                        </div>
                        <div class="form-group">
                            <label for="price">% giảm</label>
                            <input class="form-control" id="number" min="0" max="100"
                                placeholder="Nhập số % giảm" name="number" type="number" required />
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button"
                            onclick="removeMessageCreateError()">
                            Đóng
                        </button>
                        <button class="btn btn-primary" type="submit" class="close" name="save"
                            onclick="validForm()">
                            Tạo mới
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @csrf
    </form>
    <form method="post">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="delete-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa coupon</h4>
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
    @if (session()->has('isCreateSuccess') && session()->get('isCreateSuccess'))
        <script>
            $(function() {
                alertSuccess('Thêm mới thành công!')
            })
        </script>
    @endif
    @if (session()->has('isDeleteSuccess') && session()->get('isDeleteSuccess'))
        <script>
            $(function() {
                alertSuccess('Xóa thành công!')
            })
        </script>
    @endif
    @if (session()->has('isUpdateSuccess') && session()->get('isUpdateSuccess'))
        <script>
            $(function() {
                alertSuccess('Cập nhật thành công!')
            })
        </script>
    @endif
    <script>
        function routeDelete(code) {
            return "{{ route('coupons.delete', 0) }}".replace(/\d$/, code);
        }

        function routeUpdate(code) {
            return "{{ route('coupons.put', 0) }}".replace(/\d$/, code);
        }

        function alertSuccess(message) {
            swal(message, "", "success", {
                button: "OK!",
            })
        }

        function alertError(message) {
            swal(message, "", "error", {
                button: "OK!",
            })
        }

        function validForm() {

        }

        function removeMessageCreateError() {
            document.getElementById("name-error").style.display = 'none';
            document.getElementById("code-error").style.display = 'none';
            document.getElementById("time-error").style.display = 'none';
            document.getElementById("number-error").style.display = 'none';
        }

        $(document).ready(function() {
            $.validator.addMethod("greaterThan", function(value, element, param) {
                var $otherElement = $(param);
                return parseInt(value, 10) >= parseInt($otherElement.val(), 10);
            }, "Đơn giá phải lớn hơn giá khuyến mại.");
            // console.log($('#create-products').parent())
            $('#create-products').parent().validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,

                rules: {
                    coupon_name: {
                        required: true,
                    },
                    code: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    number: {
                        required: true,
                    }

                },
                messages: {
                    coupon_name: {
                        required: "Không được để trống tên."
                        // minlength: "it nhất 2 ký tự"
                    },
                    code: {
                        required: "Không được để trống mã."
                        // minlength: "it nhất 2 ký tự"
                    },
                    time: {
                        required: "Không được để trống số lượng.",
                    },
                    number: {
                        required: "Không được để trống giảm giá."
                    }
                }
            });
            $('#form-edit').validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,

                rules: {
                    editName: {
                        required: true
                    },

                    editCode: {
                        required: true,
                    },
                    editTime: {
                        required: true,
                    },
                    editNumber: {
                        required: true,
                    }

                },
                messages: {
                    editName: {
                        required: "Không được để trống tên."
                        // minlength: "it nhất 2 ký tự"
                    },
                    editCode: {
                        required: "Không được để trống mã."
                        // minlength: "it nhất 2 ký tự"
                    },
                    editTime: {
                        required: "Không được để trống số lượng.",
                    },
                    editNumber: {
                        required: "Không được để trống giảm giá."
                    }
                }
            })
        });

        function deleteDish(code) {
            $('#delete-category').parents('form').attr('action', routeDelete(code))
            // $('#delete-category').append('<input type="hidden" name="myfieldname"/>')
        }

        function showDetail(name, id, code, time, number) {
            $('#form-edit').attr('action', routeUpdate(code)).valid()
            $('#editName').val(name);
            $('#editCode').val(code);
            $('#editTime').val(time);
            $('#editNumber').val(number);

        }
    </script>
    <style>
        label.error {
            color: red;
            font-size: 14px;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }

        .search {
            margin-left: 0.2vw;
        }
    </style>

@endsection
