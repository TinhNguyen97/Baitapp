<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slides;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slides::all();
        $newProducts = Products::orderByRaw('created_at DESC')->limit(4)->get();
        // dd($newProducts);
        // dd($newProducts);
        return view('home.index', [
            'slides' => $slides,
            'newProducts' => $newProducts
        ]);
    }
    public function search(Request $request)
    {
        $allProductSearch = DB::table('products')
            ->where('products.name', 'like', '%' . $request->key . '%')
            ->orWhere('products.unit_price', $request->key)
            ->latest()
            ->paginate(8);
        $allProducts = Products::where('name', 'like', '%' . $request->key . '%')
            ->orWhere('products.unit_price', $request->key)
            ->latest()->get();
        // dd($allProductSearch);
        // dd($newProducts);
        return view(
            'home.search',
            [
                'allProductSearch' => $allProductSearch,
                'allProducts' => $allProducts,
                'request' => $request,
                'key' => $request->key
            ]
        );
    }
    public function typeSearch(Request $request, $idType)
    {
        $allProductSearch = Products::where('id_type', $idType)->paginate(8);
        $allProducts = Products::where('id_type', $idType)->get();
        return view(
            'home.producttype',
            [
                'allProductSearch' => $allProductSearch,
                'allProducts' => $allProducts,
                'request' => $request
            ]
        );
    }
    public function details($id)
    {
        $product = Products::find($id);
        $allProducts = Products::where('id_type', $product->id_type)->get();
        $relativeProducts = Products::where('id_type', $product->id_type)->paginate(3);
        return view('products.detail', [
            'product' => $product,
            'relativeProducts' => $relativeProducts,
            'allProducts' => $allProducts
        ]);
    }
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {

        return view('auth.register');
    }
    public function checkRegister(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'full_name' => 'required',
                'password' => 'required|min:6|max:20',
                're_pass' => 'same:password',
                'phone' => 'required|regex:/^0[0-9]{9,10}$/',
                'address' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập email đúng định dạng.',
                'email.unique' => 'Email đã có người sử dụng.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
                'full_name.required' => 'Vui lòng nhập tên.',
                'password.required' => 'Vui lòng nhập password.',
                're_pass.same' => 'Mật khẩu không trùng khớp.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.max' => 'Mật khẩu nhiều nhất là 20 ký tự.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.regex' => 'Số điện thoại không hợp lệ.'

            ]
        );

        User::create($request->all());
        return back()->with('success', 'Tạo tài khoản thành công!');
    }
    public function checkLogin()
    {

        return view('auth.register');
    }
}
