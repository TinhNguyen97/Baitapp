@extends('layouts.adminlayout')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <h1>Thêm thông tin website</h1>
                        </div>

                    </div>

                </div>
            </section>
            @foreach ($infor as $key => $item)
                <form action="{{ route('infors.update', $item->id) }}" method="post">
                    <div class="form-group">
                        <p><label>Thông tin liên hệ</label></p>
                        <textarea name="contact" class="editor" cols="30" rows="7" style="width:100%" placeholder="Thông tin liên hệ">{!! $item->info_contact !!}</textarea>
                    </div>
                    <div class="form-group">
                        <p><label>Bản đồ</label></p>
                        <textarea name="map" cols="30" rows="7" style="width:100%" placeholder="Bản đồ">{{ $item->info_map }}</textarea>
                    </div>
                    <div style="text-align: center">
                        <button class="btn btn-primary">Cập nhật thông tin</button>
                    </div>
                </form>
            @endforeach
        </section>
        @if (session()->has('addsuccess') && session()->get('addsuccess'))
            <script>
                $(function() {
                    alertSuccess('Cập nhật thành công!')
                })
            </script>
        @endif
    </div>
@endsection
