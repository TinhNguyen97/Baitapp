@extends('layouts.homelayout')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Liên hệ</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{ route('homes.index') }}">Trang chủ</a> / <span>Liên hệ</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    @foreach ($info as $key => $item)
        <div class="beta-map">

            <div class="abs-fullwidth beta-map wow flipInX container">

                <iframe src="{{ $item->info_map }}" width="600" height="450" style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>
        <div class="container">
            <div id="content" class="space-top-none">

                <div class="space50">&nbsp;</div>
                <div class="row">

                    <div class="col-sm-4">
                        <h2>Thông tin liên hệ</h2>
                        <div class="space20">&nbsp;</div>
                        {!! $item->info_contact !!}



                    </div>
                </div>
            </div> <!-- #content -->
        </div>
    @endforeach
@endsection
