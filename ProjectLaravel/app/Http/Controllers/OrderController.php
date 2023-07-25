<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->paginate(5);
        // dd($orders->total());
        // dd(count($orders));
        return view('orders.index', ['orders' => $orders]);
    }
    public function orderDetails($order_id)
    {
        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')->where('order_details.order_id', $order_id)
            ->paginate(5);
        // dd($details);
        return view('orders.orderdetail', ['details' => $details]);
    }
}
