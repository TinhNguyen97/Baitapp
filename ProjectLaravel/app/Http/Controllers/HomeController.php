<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slides;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Can;
use PhpParser\Node\Expr\FuncCall;
use stdClass;

class HomeController extends Controller
{
    public function index()

    {
        $slides = Slides::all();
        $newProducts = Products::orderByRaw('created_at DESC')->limit(4)->get();
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
            ->orWhere('products.promotion_price',  $request->key)
            ->latest()
            ->paginate(8);
        $allProducts = Products::where('name', 'like', '%' . $request->key . '%')
            ->orWhere('products.unit_price', $request->key)
            ->orWhere('products.promotion_price',  $request->key)
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
    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng.',
            'password.required' => 'Vui lòng nhập password.',
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credentials)) {
            return redirect('home')->with('success', 'Đăng nhập thành công');
        }
        return back()->with('error', 'Tài khoản hoặc mật khẩu không đúng!')->withInput();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('home');
    }
    public function profile()
    {
        $user = Auth::user();
        abort_if(!$user, 404);
        $user->email = $this->obfuscate_email($user->email);
        return view('auth.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        abort_if(!$user, 404);
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'address' => 'required'
        ], [
            'full_name.required' => 'Vui lòng nhập tên.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'phone.regex' => 'Số điện thoại không hợp lệ.'
        ]);
        $dataInsert = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address

        ];
        User::where('id', Auth::id())->update($dataInsert);
        $user = User::find(Auth::id());
        return redirect(route('homes.profile', $user->id))->with('success', 'Cập nhật thành công!');
    }
    public function obfuscate_email($email)
    {
        $em   = explode("@", $email);
        $name = implode('@', array_slice($em, 0, count($em) - 1));
        $len  = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }
    public function changePassword()
    {
        return view('auth.changepassword');
    }
    public function handleChangePass(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        abort_unless($user, 404);
        $request->validate(
            [
                'current_pass' => 'required',
                'new_pass' => 'required|min:6|max:20',
                'renew_pass' => 'same:new_pass',
            ],
            [
                'current_pass.required' => 'Vui lòng nhập mật khẩu hiện tại.',
                'renew_pass.same' => 'Mật khẩu mới không trùng khớp.',
                'new_pass.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'new_pass.max' => 'Mật khẩu nhiều nhất là 20 ký tự.',
                'new_pass.required' => 'Vui lòng nhập mật khẩu mới.',
            ]
        );
        if ($request->current_pass == $request->new_pass) {
            return back()->with('duplicate', 'Mật khẩu mới không được trùng với mật khẩu hiện tại!');
        }
        // dd($request->all());
        $isMatched = Hash::check($request->current_pass, $user->password);

        if ($isMatched) {

            $data = ['password' => $request->new_pass];

            $user->update($data);
            return back()->with('success', 'Đổi mật khẩu thành công!');
        } else {
            return back()->with('error', 'Mật khẩu hiện tại không đúng!');
        }
    }
    public function about()
    {
        return view('home.about');
    }
    public function contact()
    {
        return view('home.contact');
    }
    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);
        $oldCart = session('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        // Session::forget('cart');
        return back();
    }
    public function deleteFromCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // dd($oldCart);
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        // dd(Session::get('cart'));
        return back();
    }
    public function deleteAllCart()
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
        return back();
    }
    public function orderDetail(Request $request)
    {
        // if (Session::has('cart')) {
        // $carts = Session::get('cart')->items;
        // dd($carts);
        // dd($carts[60]['item']['id']);
        // dd($carts);
        //     $idProducts = array_keys($carts);
        //     foreach ($idProducts as $item) {
        //         $idProduct = $item;
        //         $product = OrderDetail::where('product_id', $idProduct)->first();
        //         $qty = $carts[$item]['qty'];
        //         if ($product) {
        //             $qtyDb = $product->quantity;

        //             OrderDetail::where('product_id', $idProduct)->update([
        //                 'quantity' => $qtyDb + $qty,
        //             ]);
        //         } else {
        //             OrderDetail::create([
        //                 'user_id' => Auth::id(),
        //                 'product_id' => $idProduct,
        //                 'quantity' => $qty,
        //             ]);
        //         }
        //     }
        // }
        // $listOrderDetail = DB::table('order_details')
        //     ->join('products', 'order_details.product_id', '=', 'products.id')
        //     ->select(
        //         'order_details.id AS order_detail_id',
        //         'order_details.user_id',
        //         'order_details.quantity',
        //         'products.*'
        //     )
        //     ->get();
        // dd($listOrderDetail);
        // Session::forget('cart');
        return view('home.orderdetail');
    }
}
