<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
// use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('orders.order_status_id', 1)
            ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
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
        // DB::enableQueryLog();
        $allOrders = DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
            ->where('orders.order_status_id', '=', 1)
            ->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->key . '%');
                $query->orWhere('phone', 'like', '%' . $request->key . '%');
            })
            ->latest()
            ->paginate(5);
        // dd($allOrders);
        // dd(DB::getQueryLog());
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
        $emailTo = Order::find($id)->email;
        Mail::send(
            'emails.ordersuccess',
            [],
            function ($email) use ($emailTo) {
                $email->subject('Đơn hàng đang giao');
                $email->to($emailTo);
            }
        );

        return back()->with(['successApprove' => true]);
    }
    public function history()
    {
        $orders = DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('orders.order_status_id', 2)
            ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
            ->paginate(5);
        return view('orders.history', ['orders' => $orders]);
    }
    public function handleCancel($id)
    {
        DB::table('orders')->where('id', $id)->update(['order_status_id' => 3]);
        $emailTo = Order::find($id)->email;
        Mail::send(
            'emails.ordercancel',
            [],
            function ($email) use ($emailTo) {
                $email->subject('Đơn hàng bị hủy');
                $email->to($emailTo);
            }
        );
        return back()->with(['successCancel' => true]);
    }
    public function orderCancel()
    {
        $orders = DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('orders.order_status_id', 3)
            ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
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
    public function searchOrderCancel(Request $request)
    {
        // dd(1);
        $allOrders = DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('orders.order_status_id', '=', 3)
            ->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->key . '%');
                $query->orWhere('phone', 'like', '%' . $request->key . '%');
            })
            ->latest()
            ->paginate(5);
        return view('orders.searchordercancel', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }
    public function searchHistory(Request $request)
    {
        // dd(1);
        $allOrders = DB::table('orders')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->where('orders.order_status_id', '=', 2)
            ->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->key . '%');
                $query->orWhere('phone', 'like', '%' . $request->key . '%');
            })
            ->latest()
            ->paginate(5);
        return view('orders.searchhistory', [
            'allOrders' => $allOrders,
            'request' => $request,
        ]);
    }
}
