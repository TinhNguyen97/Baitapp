@extends('layouts.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Quản lý danh mục</h1>
                    </div>

                </div>
                <form action="{{ route('types.search') }}" method="get">
                    <div class="col-sm-4 input-group">
                        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="key"
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
                            <h1 class="card-title col-8 col-sm-11 abc">Danh mục</h1>

                            <button class="btn btn-primary col-4 col-sm-1" data-target="#create-products"
                                data-toggle="modal" type="button">
                                Tạo mới
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="error-404">
                            <table class="table table-bordered table-hover" id="table_category">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Tên danh mục</th>
                                        <th style="text-align: center">Ảnh danh mục</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Mô tả</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ngày tạo</th>
                                        <th class="d-none d-xl-table-cell" style="text-align: center">Ngày cập nhật</th>

                                        <th colspan="2" style="text-align: center">
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($allTypes) !== 0)
                                        @foreach ($allTypes as $key => $item)
                                            <tr>
                                                <th scope="row" style="text-align: center">
                                                    {{ $loop->iteration + ($allTypes->currentPage() - 1) * $allTypes->perPage() }}
                                                </th>
                                                <td style="text-align: center">{{ $item->name }}</td>
                                                <td style="text-align: center"><img width="100px" height="100px"
                                                        class="image" src="{{ asset('uploads' . '\\' . $item->image) }}">
                                                </td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->description }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->created_at }}</td>
                                                <td class="d-none d-xl-table-cell" style="text-align: center">
                                                    {{ $item->updated_at }}</td>
                                                <td style="text-align: center"><button class="btn btn-primary"
                                                        data-target="#edit-category" data-toggle="modal" type="button"
                                                        onclick="showDetail.call(this,
                                                            '{{ $item->name }}',
                                                           {{ $item->id }} ,
                                                           '{{ $item->image }}',
                                                           '{{ $item->description }}'
                                                           )">
                                                        <i class="fa-solid fa-pen-to-square"></i></button></td>
                                                <td style="text-align: center"><button class="btn btn-danger"
                                                        data-target="#delete-category" data-toggle="modal" type="button"
                                                        onclick="deleteDish({{ $item->id }})"><i
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
            {{ $allTypes->links() }}
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
                        <h4 class="modal-title">Chỉnh sửa danh mục</h4>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" id="editName" name="editName" placeholder="Nhập tên sản phẩm"
                                type="text" required />
                        </div>


                        <div class="form-group">
                            <label for="image">Ảnh danh mục</label>
                            <!-- <p id="imageCategory"></p> -->
                            <img src="" id="editImage" width="100px" height="100px" />
                            <input class="form-control" id="editImage" type="file" name="editImage"
                                onchange="imagePreview(this, '#form-edit', '#error-file-edit')" />
                            <p id="error-file-edit"></p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <input id="editDescr" class="form-control" placeholder="Nhập mô tả" name="editDescr"
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
    <form action="" method="post" enctype="multipart/form-data" id="create-form">
        <div class="modal fade" id="create-products">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo mới danh mục</h4>
                        <button aria-label="Close" onclick="removeMessageCreateError()" class="close"
                            data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input name="name" class="form-control" id="name" placeholder="Nhập tên danh mục"
                                type="text" />
                        </div>

                        <div class="form-group">
                            <label for="image">Ảnh danh mục</label>
                            <input class="form-control" name="image" id="image" type="file" required
                                onchange="imagePreview(this, '#create-form', '#error-file-create') " />
                            <p id="error-file-create"></p>
                        </div>
                        <div class="form-group">
                            <label for="price">Mô tả</label>
                            <input class="form-control" id="description" placeholder="Nhập mô tả" name="description"
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
                        <h4 class="modal-title">Xóa danh mục</h4>
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
            return "{{ route('types.delete', 0) }}".replace(/\d$/, id);
        }

        function routeUpdate(id) {
            return "{{ route('types.put', 0) }}".replace(/\d$/, id);
        }
    </script>
    <script src="{{ asset('js/type.js') }}"></script>
@endsection
