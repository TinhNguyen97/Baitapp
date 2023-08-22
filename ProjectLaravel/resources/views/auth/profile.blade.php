@extends('layouts.homelayout')
@section('content')
    <div class="container">
        <div id="content">

            <form action="{{ route('homes.updateprofile', $user->id) }}" method="post" class="beta-form-checkout">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-6">
                        <h4>Thông tin tài khoản</h4>
                        <div class="space20">&nbsp;</div>


                        <div>
                            <label for="email">Email*</label>
                            <input name="email" type="email" id="email" value="{{ $user->email }}" readonly>
                        </div>

                        <div>
                            <label for="name">Họ và tên*</label>
                            <input name="full_name" type="text" id="name" value="{{ $user->full_name }}">
                        </div>
                        @error('full_name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror

                        <div>
                            <label for="address">Địa chỉ*</label>
                            <input name="address" type="text" id="address" value="{{ $user->address }}">
                        </div>
                        @error('address')
                            <span style="color:red">{{ $message }}</span>
                        @enderror


                        <div>
                            <label for="phone">SĐT*</label>
                            <input name="phone" type="text" id="phone" value="{{ $user->phone }}">
                        </div>
                        @error('phone')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div>
                            @if (Auth::check())
                                <button type="button" class="btn" style="border: 1px solid #e1e1e1"><a
                                        href="{{ route('homes.index') }}">Hủy
                                        bỏ</a></button>
                            @endif
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
