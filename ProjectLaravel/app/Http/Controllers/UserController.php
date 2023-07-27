<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // $orders = DB::table('orders')
        //     ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
        //     ->where('orders.order_status_id', 1)
        //     ->select('orders.*', 'order_statuses.id AS osi', 'order_statuses.status AS status')
        //     ->paginate(5);
        // dd($orders->total());
        // dd($orders);
        dd(Auth::user()->email);
        return view('users.index');
    }
}
