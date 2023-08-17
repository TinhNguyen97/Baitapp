@extends('admin.adminlayout')
@section('content')
    @php
        $revenue = 0;
        foreach ($revenues as $key => $item) {
            if ($item->promotion_price < $item->unit_price) {
                $revenue += $item->promotion_price * $item->quantity_sold * (1 - $item->number / 100);
            } else {
                $revenue += $item->unit_price * $item->quantity_sold * (1 - $item->number / 100);
            }
        }
    @endphp
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Thống kê</h1>

                    </div>


                </div>
                <ul>
                    <li>Số sản phẩm bán được trong tháng {{ date('m') . ' là: ' . $countProduct->count . ' sản phẩm' }}</li>
                    <li>Doanh thu: {{ number_format($revenue, 0, ',', '.') . ' VNĐ' }} </li>
                </ul>
            </div>
        </section>
    </div>
    <style>
        ul {
            color: blue
        }
    </style>
@endsection
