<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailConfirm;
use App\Jobs\SendEmailCoverPass;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Infors;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slides;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $topSaleProducts = DB::table('products')
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('orders.order_status_id', 2)
            ->groupBy('products.name')
            ->orderByRaw('count(products.name) DESC')
            ->orderByRaw('products.name')
            ->limit(8)
            ->get('products.*');
        // dd($topSaleProducts);
        return view('home.index', [
            'slides' => $slides,
            'newProducts' => $newProducts,
            'topSaleProducts' => $topSaleProducts
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
        $comments = Comment::where('product_id', $id)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->get();
        // dd($comments);
        return view('products.detail', [
            'product' => $product,
            'relativeProducts' => $relativeProducts,
            'allProducts' => $allProducts,
            'comments' => $comments
        ]);
    }
    public function login()
    {
        Session::put('url', url()->previous());
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

        $remember = $request->has('remember');
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

        if (Auth::attempt($credentials, $remember)) {

            if (!Auth::user()->is_active) {
                return back()->with('ban', 'Tài khoản của bạn đã bị khóa!')->withInput();
            }
            // if (Auth::user()->is_admin) {
            //     return redirect('products');
            // }

            // keyword intended
            return redirect(Session::get('url'));;
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
        $info = DB::table('infors')->where('id', 3)->get();;
        return view('home.contact', ['info' => $info]);
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
    public function order(Request $request)
    {
        return view('home.order');
    }

    public function updateCart(Request $request, $id)
    {
        $quantity = $request->quantity ? $request->quantity : 1;
        $oldCart = session('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->updateCart($id, $quantity);
        Session::put('cart', $cart);
        // dd(Session::get('cart'));
        return back();
    }
    public function orderDetail()
    {
        return view('home.orderdetail');
    }

    public function handleOrder(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên',
            'email.required' => 'Vui lòng nhập email',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'email.email' => 'Vui lòng nhập email đúng định dạng.',
            'phone.regex' => 'Số điện thoại không hợp lệ.'
        ]);
        $id = Order::create($request->all())->id;
        if (Session::has('cart')) {
            $carts = Session::get('cart')->items;
            $idProducts = array_keys($carts);
            foreach ($idProducts as $item) {
                $idProduct = $item;
                $product = OrderDetail::where('product_id', $idProduct)->first();
                $qty = $carts[$item]['qty'];
                if ($product && $product->product_id == $idProduct && $product->order_id == $id) {
                    $qtyDb = $product->quantity;

                    OrderDetail::where('product_id', $idProduct)->update([
                        'quantity' => $qtyDb + $qty,
                    ]);
                } else {
                    OrderDetail::create([
                        'user_id' => Auth::id(),
                        'product_id' => $idProduct,
                        'order_id' => $id,
                        'quantity' => $qty,
                    ]);
                }
            }
            //gửi mail xác nhận đơn hàng
            // Mail::send(
            //     'emails.confirmorder',
            //     [
            //         'request' => $request,
            //         'id' => $id
            //     ],
            //     function ($email) use ($request) {
            //         $email->subject('Xác nhận đơn hàng');
            //         $email->to($request->email);
            //     }
            // );
            $items = Session::get('cart')->items;
            $totalQty = Session::get('cart')->totalQty;
            $totalPrice = Session::get('cart')->totalPrice;
            SendEmailConfirm::dispatch($request->email, $id, $request, $items, $totalQty, $totalPrice);
            Session::forget('cart');
        }
        Notification::create(['user_id' => Auth::id()]);

        return view('home.success');
    }
    public function history()
    {
        DB::enableQueryLog();
        $id = Auth::id();
        $list = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.user_id', $id)
            ->where('order_statuses.id', 2)
            ->groupBy('products.id')
            ->selectRaw('*, sum(order_details.quantity) AS sq')
            ->get();
        // dd(DB::getQueryLog());
        return view('home.history', ['list' => $list]);
    }
    public function forgetPass()
    {

        return view('home.forgetpass');
    }
    public function checkForgetPass(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users'
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.'
        ]);
        $token = rand();

        $user = User::where('email', $request->email)->first();

        $user->update(['token' => $token]);
        $appUrl = $_SERVER['APP_URL'];
        $httpHost = $_SERVER['HTTP_HOST'];
        SendEmailCoverPass::dispatch($user->email, $user->id, $user->full_name, $user->token, $appUrl, $httpHost);
        return back()->with('check', 'Vui lòng check email để lấy lại mật khẩu');
    }
    public function getPass(User $user, $token)
    {
        if ($user->token === $token) {
            // dd($user);
            return view('home.getpass');
        };
        abort(404);
    }
    public function checkPass(User $user, Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:20',
            're-password' => 'required|same:password'
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu.',
            're-password.required' => 'Vui lòng nhập mật khẩu.',
            're-password.same' => 'Mật khẩu không trùng khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu nhiều nhất là 20 ký tự.',
        ]);
        $user->update(['password' => $request->password, 'token' => null]);
        return redirect()->route('homes.login')->with('changepasssuccess', 'Đặt lại mật khẩu thành công.');
    }
    public function comment(Request $request, $id)
    {
        $data = ['content' => $request->content, 'product_id' => $id, 'user_id' => Auth::id()];
        Comment::create($data);
        return back();
    }
}
