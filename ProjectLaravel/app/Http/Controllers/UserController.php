<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // dd(Auth::user()->email);
        $users = DB::table('users')->paginate(5);
        // dd($users);
        return view('users.index', ['users' => $users]);
    }
    public function handleActive($id)
    {
        $user = User::find($id);
        if ($user->is_admin) {
            return back()->with(['errorlock' => true]);
        };
        $isActive = $user->is_active;
        $email = $user->email;
        if ($isActive) {
            DB::table('users')->where('id', $id)->update(['is_active' => 0]);
            return back()->with(['locksuccess' => true, 'email' => $email]);
        } else {
            DB::table('users')->where('id', $id)->update(['is_active' => 1]);
        };
        return back()->with(['unlocksuccess' => true, 'email' => $email]);
    }

    public function handleDelete($id)
    {

        $user = User::find($id);
        abort_if(!$user, 404);
        if ($user->is_admin) {
            return back()->with(['preventDelete' => true]);
        };
        User::destroy($id);
        return back()->with(['isDeleteSuccess' => true]);
    }

    public function search(Request $request)
    {
        $users = DB::table('users')
            ->where('full_name', 'like', '%' . $request->key . '%')
            ->orWhere('email', 'like', '%' . $request->key . '%')
            ->paginate();

        return view('users.search', ['users' => $users, 'request' => $request]);
    }
    public function activeAdmin($id)
    {
        $user = User::find($id);
        if (!$user->is_active) {
            return back()->with(['neededUnlock' => true]);
        }
        if ($user->is_admin) {
            return back()->with(['admined' => true]);
        };
        DB::table('users')->where('id', $id)->update(['is_admin' => 1]);
        return back()->with(['adminsuccess' => true]);
    }
}
