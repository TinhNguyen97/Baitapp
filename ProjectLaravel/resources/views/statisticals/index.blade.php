@extends('layouts.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Thống kê</h1>
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
                            <!-- /.card-header -->
                            <div class="card-body" id="error-404">
                                <table class="table table-bordered table-hover" id="table_category">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Tháng/năm</th>
                                            <th style="text-align: center">Số sản phẩm đã bán</th>
                                            <th style="text-align: center">Doanh thu(VNĐ)</th>
                                            <th style="text-align: center">Ngày tạo</th>
                                            <th style="text-align: center">Ngày cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($statisticals) !== 0)
                                            @foreach ($statisticals as $key => $item)
                                                <tr>
                                                    <td style="text-align: center">{{ $item->month_year }}</td>
                                                    <td style="text-align: center">{{ $item->count_product }}</td>
                                                    <td style="text-align: center">{{ formatMoney($item->count_revenue) }}
                                                    </td>
                                                    <td style="text-align: center">{{ $item->created_at }}</td>
                                                    <td style="text-align: center">{{ $item->updated_at }}</td>
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
            <!-- /.container-fluid -->
        </section>

    </div>

@endsection
