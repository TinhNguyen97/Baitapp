<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
// use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
            ->where('orders.order_status_id', 1)
            ->select('orders.*', 'order_status.id AS osi', 'order_status.status AS status')
            ->paginate(5);
        // dd($orders->total());
        // dd($orders);
        return view('orders.index', ['orders' => $orders]);
    }
    public function orderDetails($order_id)
    {
        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.order_id', $order_id)
            ->paginate(5);
        // $count = 
        // $test = OrderDetail::with('product')->where('order_id', $order_id)->get();
        // $test2 = Products::with(['orderDetails'])->whereHas('orderDetails', function ($query) use ($order_id) {
        //     $query->where('order_id', $order_id);
        // })->paginate(5);
        // dd($test2[0]->orderdetails);
        return view('orders.orderdetail', ['details' => $details]);
    }
    public function search(Request $request)
    {
        $allOrders = DB::table('orders')
            ->where('email', 'like', '%' . $request->key . '%')
            ->orWhere('phone', 'like', '%' . $request->key . '%')
            ->latest()
            ->paginate(5);
        return view('orders.search', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }
    public function searchDetail(Request $request)
    {
        $allOrders = DB::table('orders')
            ->where('email', 'like', '%' . $request->key . '%')
            ->orWhere('phone', 'like', '%' . $request->key . '%')
            ->latest()
            ->paginate(5);
        return view('orders.search', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }
    public function handleApprove($id)
    {
        DB::table('orders')->where('id', $id)->update(['order_status_id' => 2]);
        return back()->with(['successApprove' => true]);
    }
    public function history()
    {
        $orders = DB::table('orders')
            ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
            ->where('orders.order_status_id', 2)
            ->select('orders.*', 'order_status.id AS osi', 'order_status.status AS status')
            ->paginate(5);
        return view('orders.history', ['orders' => $orders]);
    }
    public function handleCancel($id)
    {
        DB::table('orders')->where('id', $id)->update(['order_status_id' => 3]);
        return back()->with(['successCancel' => true]);
    }
    public function orderCancel()
    {
        $orders = DB::table('orders')
            ->join('order_status', 'orders.order_status_id', '=', 'order_status.id')
            ->where('orders.order_status_id', 3)
            ->select('orders.*', 'order_status.id AS osi', 'order_status.status AS status')
            ->paginate(5);
        return view('orders.cancel', ['orders' => $orders]);
    }
    public function historyDetail($order_id)
    {
        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.order_id', $order_id)
            ->paginate(5);
        return view('orders.historydetail', ['details' => $details]);
    }
}
