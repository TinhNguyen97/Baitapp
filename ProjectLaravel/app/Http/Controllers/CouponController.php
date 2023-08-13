<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        // echo public_path('uploads' . '\\' . '123');
        // die;
        $allCoupons = DB::table('coupons')->latest()
            ->paginate(5);
        // dd($allCoupons);
        return view('coupons.index', ['allCoupons' => $allCoupons]);
    }
    public function search(Request $request)
    {
        $coupons = Coupon::where('name', 'like', '%' . $request->key . '%')
            ->orwhere('code', 'like', '%' . $request->key . '%')->get();
        $allCouponSearch = DB::table('coupons')
            ->where('name', 'like', '%' . $request->key . '%')
            ->orwhere('code', 'like', '%' . $request->key . '%')
            ->latest()
            ->paginate(5);
        return view('coupons.search', [
            'allCouponSearch' => $allCouponSearch,
            'request' => $request,
            'coupons' => $coupons,
            'keySearch' => $request->key
        ]);
    }
    public function put(Request $request, $id)
    {
        // dd($request->editCode);
        $coupons = Coupon::find($id);

        abort_if(!$coupons, 404);
        $request->validate(
            [
                'editName' => 'required',
                'editCode' => 'required',
                'editTime' => 'required',
                'editNumber' => 'required'
            ],
            [
                'editName.required' => 'Tên không được để trống.',
                'editCode.required' => 'Không được để trống.',
                'editTime.required' => 'Không được để trống.',
                'editNumber.required' => 'Không được để trống.'
            ]
        );

        // dd($request->all());
        Coupon::where('id', $id)->update([
            'name' => $request->editName,
            'code' => $request->editCode,
            'time' => $request->editTime,
            'number' => $request->editNumber
        ]);
        return back()->with(['isUpdateSuccess' => true]);
    }
    public function add(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required',
                'time' => 'required',
                'number' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'code.required' => 'Không được để trống.',
                'time.required' => 'Không được để trống.',
                'number.required' => 'Không được để trống.',
            ]
        );


        Coupon::create($request->all());

        return back()->with(['isCreateSuccess' => true]);
    }
    public function delete($id)
    {

        $coupon = Coupon::find($id);
        abort_if(!$coupon, 404);
        Coupon::destroy($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function addSearch(Request $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'code' => 'required',
                'time' => 'required',
                'number' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'code.required' => 'Không được để trống.',
                'time.required' => 'Không được để trống.',
                'number.required' => 'Không được để trống.',
            ]
        );


        Coupon::create(array_merge($request->all()));

        return back()->with(['isCreateSuccess' => true]);
    }
}
