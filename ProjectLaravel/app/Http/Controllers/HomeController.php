<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailConfirm;
use App\Jobs\SendEmailCoverPass;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Coupon\CouponServiceInterface;
use App\Services\Info\InfoServiceInterface;
use App\Services\Notification\NotificationServiceInterface;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\Slide\SlideServiceInterface;
use App\Services\TypeProduct\TypeProductServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $productService;
    private $slideService;
    private $typeProductService;
    private $userService;
    private $infoService;
    private $couponService;
    private $orderService;
    private $orderDetailService;
    private $notificationService;
    private $commentService;
    public function __construct(
        ProductServiceInterface $productService,
        SlideServiceInterface $slideService,
        TypeProductServiceInterface $typeProductService,
        UserServiceInterface $userService,
        InfoServiceInterface $infoService,
        CouponServiceInterface $couponService,
        OrderServiceInterface $orderService,
        OrderDetailServiceInterface $orderDetailService,
        NotificationServiceInterface $notificationService,
        CommentServiceInterface $commentService

    ) {
        $this->productService = $productService;
        $this->slideService = $slideService;
        $this->typeProductService = $typeProductService;
        $this->userService = $userService;
        $this->infoService = $infoService;
        $this->couponService = $couponService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->notificationService = $notificationService;
        $this->commentService = $commentService;
    }
    public function index()
    {
        $slides = $this->slideService->all();
        $newProducts = $this->productService->getNewProducts();
        $topSaleProducts = $this->productService->topSaleProducts();
        return view('home.index', [
            'slides' => $slides,
            'newProducts' => $newProducts,
            'topSaleProducts' => $topSaleProducts
        ]);
    }
    public function search(Request $request)
    {
        $allProductSearch = $this->productService->getAllProductSearch($request);
        $allProductWithKeys = $this->productService->getAllProductWithKeys($request);
        return view(
            'home.search',
            [
                'allProductSearch' => $allProductSearch,
                'allProducts' => $allProductWithKeys,
                'request' => $request,
                'key' => $request->key
            ]
        );
    }
    public function typeSearch(Request $request, $idType)
    {
        $type = $this->typeProductService->find($idType)->name;
        $allProductSearchByType = $this->productService->getAllProductSearchByType($idType, 1);
        $allProductByType = $this->productService->getAllProductByType($idType, 1);
        return view(
            'home.producttype',
            [
                'type' => $type,
                'allProductSearch' => $allProductSearchByType,
                'allProducts' => $allProductByType,
                'request' => $request
            ]
        );
    }



    public function checkRegister(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users,email|max:255',
                'full_name' => 'required|max:255',
                'password' => 'required|min:6|max:20',
                're_pass' => 'same:password',
                'phone' => 'required|regex:/^0[0-9]{9,10}$/',
                'address' => 'required|max:255'
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập email đúng định dạng.',
                'email.unique' => 'Email đã có người sử dụng.',
                'email.max' => 'Vui lòng nhập email ngắn hơn.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
                'address.max' => 'Vui lòng nhập địa chỉ ngắn hơn.',
                'full_name.required' => 'Vui lòng nhập tên.',
                'full_name.max' => 'Vui lòng nhập tên ngắn hơn.',
                'password.required' => 'Vui lòng nhập password.',
                're_pass.same' => 'Mật khẩu không trùng khớp.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.max' => 'Mật khẩu nhiều nhất là 20 ký tự.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.regex' => 'Số điện thoại không hợp lệ.'

            ]
        );

        $this->userService->create($request->all());
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
            if (str_contains(Session::get('url'), 'get-pass') || str_contains(Session::get('url'), 'register')) {
                return $this->index();
            }
            return redirect(Session::get('url'));;
        }
        return back()->with('error', 'Tài khoản hoặc mật khẩu không đúng!')->withInput();
    }
    public function logout()
    {
        Auth::logout();
        Session::forget('cart');
        return redirect('home');
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
        $this->userService->update($dataInsert, Auth::id());
        $user = $this->userService->find(Auth::id());
        return redirect(route('homes.profile', $user->id))->with('success', 'Cập nhật thành công!');
    }


    public function handleChangePass(Request $request)
    {
        $id = Auth::id();
        $user = $this->userService->find($id);
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

            $this->userService->update($data, $id);
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
        $info = $this->infoService->find(3);
        // $info = DB::table('infors')->where('id', 3)->get();
        // dd($info);
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
        return back()->with('addsuccess', 'Thêm vào giỏ hàng thành công');
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
        return back()->with('delsuccess', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
    public function deleteAllCart()
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
        return back()->with('delallsuccess', 'Tất cả sản phẩm đã được xóa khỏi giỏ hàng');
    }
    public function order(Request $request)
    {
        if (!Session::has('cart')) {
            return view('home.blank');
        }
        $carts[] = Session::get('cart')->items;
        $message = '';
        foreach ($carts[0] as $key => $item) {
            if (!$item['item']->product_quantity) {
                $message .= '<p>Sản phẩm ' . $item['item']->name . ' đã hết hàng, xin lựa chọn sản phẩm khác.</p>';
            }
            if ($item['qty'] > $item['item']->product_quantity) {
                $message .= '<p>Do số lượng sản phẩm ' . $item['item']->name . ' có hạn, vui lòng mua sản phẩm với số lượng nhỏ hơn ' . ($item['item']->product_quantity + 1) . '.</p>';
            }
        }
        if ($message) {
            return back()->with('overquantity', $message);
        }
        return view('home.order');
    }

    public function updateCart($id, $quantity)
    {
        $oldCart = session('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        if ($quantity) {
            $cart->updateCart($id, $quantity);
        }
        Session::put('cart', $cart);
    }
    public function orderDetail()
    {
        // Session::forget('cart');
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
        // $couponId = 0;
        $number = null;
        if (Session::has('coupon')) {
            $number = Session::get('coupon')['number'];
            $couponIdSession = Session::get('coupon')['id'];
            $request['coupon_id'] =  $couponIdSession;
        } else {
            $randomCode = date('dmyhis') . rand(10, 100) . 'code';
            $fakeCoupon = [
                'coupon_name' => 'fake',
                'time' => 0,
                'number' => 0,
                'code' => $randomCode,
                'is_active' => 0
            ];
            $couponId = $this->couponService->create($fakeCoupon);
            $request['coupon_id'] =  $couponId->id;
        };
        $order = $this->orderService->create($request->all());
        $id = $order->id;
        if (Session::has('cart')) {
            $carts = Session::get('cart')->items;
            $idProducts = array_keys($carts);
            foreach ($idProducts as $item) {
                $idProduct = $item;
                $product = $this->orderDetailService->findByProductId($idProduct);
                $qty = $carts[$item]['qty'];
                if ($product && $product->product_id == $idProduct && $product->order_id == $id) {
                    $qtyDb = $product->quantity;

                    $this->orderDetailService->updateByProductId($idProduct, [
                        'quantity' => $qtyDb + $qty,
                    ]);
                } else {
                    $this->orderDetailService->create([
                        'user_id' => Auth::id(),
                        'product_id' => $idProduct,
                        'order_id' => $id,
                        'quantity' => $qty,
                    ]);
                }
            };

            $items = Session::get('cart')->items;
            $totalQty = Session::get('cart')->totalQty;
            $totalPrice = Session::get('cart')->totalPrice;

            SendEmailConfirm::dispatch($request->email, $id, $request, $items, $totalQty, $totalPrice, $number);
            Session::forget('cart');
            Session::forget('coupon');
        }
        $this->notificationService->create(['user_id' => Auth::id()]);

        return view('home.success');
    }
    public function history()
    {
        $id = Auth::id();
        $list = $this->orderDetailService->getListByUserId($id, 2);

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
        $email = $request->email;
        $user = $this->userService->findByEmail($email);
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
        $this->commentService->create($data);
        return back();
    }
}
