@extends('layouts.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Quản lý sản phẩm</h1>
                    </div>

                </div>
                <form action="{{ route('products.search') }}" method="get">
                    <div class="col-sm-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm/giá tiền" name="key"
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="{{ $request->key ? $request->key : '' }}">
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
                            <h1 class="card-title col-8 col-sm-11 abc">Sản phẩm</h1>
                            <button class="btn btn-primary col-4 col-sm-1" data-target="#create-products"
                                data-toggle="modal" type="button">
                                Tạo mới
                            </button>
                            <p style="color: blue">Tìm thấy {{ count($allProducts) }} sản phẩm!</p>
                        </div>
                        <!-- /.card-header -->
                        <div class="col-sm-12 card-body" id="error-404">
                            <table class="table table-bordered table-hover" id="table_category">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Tên sản phẩm</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Danh mục</th>
                                        <th style="text-align: center">Ảnh sản phẩm</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Đơn giá(VNĐ)</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Giá sau khuyến
                                            mại(VNĐ)</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Số lượng</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Đã bán</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Mô tả</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Kích hoạt</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ngày tạo</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ngày cập nhật</th>

                                        <th colspan="2" style="text-align: center">
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($allProductSearch) !== 0)
                                        @foreach ($allProductSearch as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($allProductSearch->currentPage() - 1) * $allProductSearch->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->name }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->tp_name }}</td>
                                                <td style="text-align: center"><img width="100px" height="100px"
                                                        class="image" src="{{ asset('uploads' . '\\' . $item->image) }}">
                                                </td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ formatMoney($item->unit_price) }}</td>
                                                <td style="text-align: center" class="promotion_price">
                                                    {{ formatMoney($item->promotion_price) }}
                                                </td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->product_quantity }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->quantity_sold }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->description }}</td>
                                                @if ($item->is_active)
                                                    <td class="d-none d-xl-table-cell"style="text-align: center">Đã kích
                                                        hoạt</td>
                                                @else
                                                    <td class="d-none d-xl-table-cell" style="text-align: center">Chưa kích
                                                        hoạt</td>
                                                @endif
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->created_at }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->updated_at }}</td>
                                                <td style="text-align: center"><button class="btn btn-primary"
                                                        data-target="#edit-category" data-toggle="modal" type="button"
                                                        onclick="showDetail.call(this,
                                                            '{{ $item->name }}',
                                                           {{ $item->id }} ,
                                                           '{{ $item->tp_name }}',
                                                           '{{ $item->image }}',
                                                           {{ $item->promotion_price }},
                                                           {{ $item->product_quantity }},
                                                           '{{ $item->description }}',
                                                           {{ $item->unit_price }},
                                                           {{ $item->type_id }},
                                                           {{ $item->is_active }}
                                                           )">
                                                        <i class="fa fa-edit"></i></button></td>
                                                <td style="text-align: center"><button class="btn btn-danger"
                                                        data-target="#delete-category" data-toggle="modal" type="button"
                                                        onclick="deleteDish({{ $item->id }})"><i
                                                            class="fa fa-trash"></i></button></td>
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
            {{ $allProductSearch->appends($request->all())->links() }}
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
                            <label>Số lượng</label>
                            <input id="editQuantity" class="form-control" placeholder="Nhập số lượng" type="number"
                                name="editQuantity" required min="0" />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <input id="editDescr" class="form-control" placeholder="Nhập giá" name="editDescr"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="type">Kích hoạt</label>
                            <select id="is_active" name="is_active">
                                <option value="1">Đã kích hoạt</option>
                                <option value="0">Chưa kích hoạt</option>
                            </select>
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
                            <select id="type" name="type_id">
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
                            <label for="price">Số lượng</label>
                            <input class="form-control" id="quantity" type="number" placeholder="Nhập số lượng"
                                min="0" name="product_quantity" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Mô tả</label>
                            <input class="form-control" id="description" placeholder="Nhập giá" name="description"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="price">Kích hoạt</label>
                            <select id="is_active" name="is_active">
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
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
            return "{{ route('products.deleteSearch', 0) }}".replace(/\d$/, id);
        }

        function routeUpdate(id) {
            return "{{ route('products.putSearch', 0) }}".replace(/\d$/, id);
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
            document.getElementById("quantity-error").style.display = 'none';
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
                    product_quantity: {
                        required: "Không được để trống số lượng."
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

                    editQuantity: {
                        required: "Không được để trống số lượng."
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

        function showDetail(name, id, tp_name, image, promotion_price, quantity, description, unit_price, type_id,
            is_active) {
            $('#form-edit').attr('action', routeUpdate(id))
            $('#editName').val(name);
            $('#editType').val(type_id);
            $('#editPrice').val(unit_price);
            $('#editPromotionPrice').val(promotion_price);
            $('#editQuantity').val(quantity);
            $('#editDescr').val(description);
            $('#editImage').attr('src', $(this).parents('.row').find('.image').attr('src'));
            $('#is_active').val(is_active)
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

        select {
            height: 36px;
            border: 1px solid #ced4da;
        }
    </style>
@endsection
