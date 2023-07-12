@extends('admin.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý sản phẩm</h1>
                    </div>
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
                                <h1 class="card-title col-11 abc">Sản phẩm</h1>

                                <button class="btn btn-primary col-1" data-target="#create-products" data-toggle="modal"
                                    type="button">
                                    Tạo mới
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="error-404">
                                <table class="table table-bordered table-hover" id="table_category">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">Tên sản phẩm</th>
                                            <th style="text-align: center">Danh mục</th>
                                            <th style="text-align: center">Ảnh sản phẩm</th>
                                            <th style="text-align: center">Đơn giá</th>
                                            <th style="text-align: center">Giá sau khuyến mại</th>
                                            <th style="text-align: center">Mô tả</th>
                                            <th style="text-align: center">Ngày tạo</th>
                                            <th style="text-align: center">Ngày cập nhật</th>

                                            <th colspan="2" style="text-align: center">
                                                Thao tác
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($allProducts) !== 0)
                                            @foreach ($allProducts as $key => $item)
                                                <tr>
                                                    <th scope="row" style="text-align: center">{{ $key + 1 }}</th>
                                                    <td style="text-align: center">{{ $item->name }}</td>
                                                    <td style="text-align: center">{{ $item->tp_name }}</td>
                                                    <td style="text-align: center"><img width="100px" height="100px"
                                                            src="{{ 'uploads' . '\\' . $item->image }}"></td>
                                                    <td style="text-align: center">{{ $item->unit_price }}</td>
                                                    <td style="text-align: center">{{ $item->promotion_price }}</td>
                                                    <td style="text-align: center">{{ $item->description }}</td>
                                                    <td style="text-align: center">{{ $item->created_at }}</td>
                                                    <td style="text-align: center">{{ $item->updated_at }}</td>
                                                    <td style="text-align: center"><button class="btn btn-primary"
                                                            data-target="#edit-category" data-toggle="modal" type="button"
                                                            onclick="showDetail(
                                                            '{{ $item->name }}',
                                                           {{ $item->id }} ,
                                                           '{{ $item->tp_name }}',
                                                           '{{ $item->image }}',
                                                           {{ $item->promotion_price }},
                                                           '{{ $item->description }}',
                                                           {{ $item->unit_price }},
                                                           {{ $item->id_type }}
                                                           )">
                                                            <i class="fa fa-edit"></i></button></td>
                                                    <td style="text-align: center"><button class="btn btn-danger"
                                                            data-target="#delete-category" data-toggle="modal"
                                                            type="button" onclick="deleteDish({{ $item->id }})"><i
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
                        <h4 class="modal-title">Chỉnh sửa sản phẩm</h4>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" id="editName" name="editName" placeholder="Nhập tên sản phẩm"
                                type="text" required />
                        </div>
                        <div class="form-group">
                            <label for="type">Danh mục</label>
                            <select id="editType" name="editType">
                                @if (!empty($allTypes))
                                    @foreach ($allTypes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Ảnh sản phẩm</label>
                            <!-- <p id="imageCategory"></p> -->
                            <img src="" id="editImage" width="100px" height="100px" />
                            <input class="form-control" id="editImage" type="file" name="editImage" />
                        </div>
                        <div class="form-group">
                            <label>Đơn giá</label>
                            <input id="editPrice" class="form-control" placeholder="Nhập giá" type="number"
                                name="editPrice" min="0" required />
                        </div>
                        <div class="form-group">
                            <label>Giá khuyến mại</label>
                            <input id="editPromotionPrice" class="form-control" placeholder="Nhập giá" type="number"
                                name="editPromotionPrice" required min="0" />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <input id="editDescr" class="form-control" placeholder="Nhập giá" name="editDescr"
                                required />
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
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="create-products">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo mới sản phẩm</h4>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input name="name" class="form-control" id="name" placeholder="Nhập tên sản phẩm"
                                type="text" required />
                        </div>
                        <div class="form-group">
                            <label for="type">Danh mục sản phẩm</label>
                            <select id="type" name="id_type">
                                @if (!empty($allTypes))
                                    @foreach ($allTypes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh sản phẩm</label>
                            <input class="form-control" name="image" id="image" type="file" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Đơn giá</label>
                            <input class="form-control" id="unit_price" type="number" placeholder="Nhập giá"
                                name="unit_price" min="0" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Giá sau khuyến mại</label>
                            <input class="form-control" id="promotion_price" type="number" placeholder="Nhập giá"
                                min="0" name="promotion_price" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Mô tả</label>
                            <input class="form-control" id="description" placeholder="Nhập giá" name="description"
                                required />
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button"
                            onclick="removeMessageCreateError()">
                            Đóng
                        </button>
                        <button class="btn btn-primary" type="submit" class="close" name="save">
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
                        <h4 class="modal-title">Xóa sản phẩm</h4>
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
        function routeDelete(id) {
            return "{{ route('products.delete', 0) }}".replace(/\d$/, id);
        }

        function routeUpdate(id) {
            return "{{ route('products.put', 0) }}".replace(/\d$/, id);
        }

        function alertSuccess(message) {
            swal(message, "", "success", {
                button: "OK!",
            })
        }

        function removeMessageCreateError() {
            document.getElementById("name-error").style.display = 'none';
            document.getElementById("image-error").style.display = 'none';
            document.getElementById("unit_price-error").style.display = 'none';
            document.getElementById("promotion_price-error").style.display = 'none';
            document.getElementById("description-error").style.display = 'none';
        }

        function removeMessageUpdateError() {
            document.getElementById("editName-error").style.display = 'none';
            document.getElementById("editPrice-error").style.display = 'none';
            document.getElementById("editPromotionPrice-error").style.display = 'none';
            document.getElementById("editDescr-error").style.display = 'none';
        }
        $(document).ready(function() {
            $('#create-products').parent().validate({
                rules: {
                    // name: {
                    //     minlength: 2
                    // }
                },
                messages: {
                    name: {
                        required: "Không được để trống tên."
                        // minlength: "it nhất 2 ký tự"
                    },
                    image: {
                        required: "Không được để trống ảnh."
                        // minlength: "it nhất 2 ký tự"
                    },
                    unit_price: {
                        required: "Không được để trống giá tiền."
                    },
                    promotion_price: {
                        required: "Không được để trống giá khuyến mại."
                    },
                    description: {
                        required: "Không được để trống mô tả sản phẩm."
                    }
                    // image: {
                    //     required: "Không được để trống ảnh."
                    // }
                }
            });
            $('#form-edit').validate({
                messages: {
                    editName: {
                        required: "Không được để trống tên."
                        // minlength: "it nhất 2 ký tự"
                    },
                    editPrice: {
                        required: "Không được để trống giá tiền."
                    },
                    editPromotionPrice: {
                        required: "Không được để trống giá khuyến mại."
                    },
                    editDescr: {
                        required: "Không được để trống mô tả sản phẩm."
                    }
                    // image: {
                    //     required: "Không được để trống ảnh."
                    // }
                }
            })
        });

        function deleteDish(id) {
            $('#delete-category').parents('form').attr('action', routeDelete(id))
            // $('#delete-category').append('<input type="hidden" name="myfieldname"/>')
        }

        function showDetail(name, id, tp_name, image, promotion_price, description, unit_price, id_type) {
            $('#form-edit').attr('action', routeUpdate(id))
            $('#editName').val(name);
            $('#editType').val(id_type);
            $('#editImage').attr('src', 'uploads\\' + image);
            $('#editPrice').val(unit_price);
            $('#editPromotionPrice').val(promotion_price);
            $('#editDescr').val(description);

        }
    </script>
    <style>
        label.error {
            color: red;
            font-size: 14px;
        }
    </style>
@endsection
