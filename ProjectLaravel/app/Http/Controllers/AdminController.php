<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        // dd(Dish::all());
        $allProducts = DB::table('products')->join('type_products', 'products.type_id', '=', 'type_products.id')->select('products.*', 'type_products.name as tp_name')->get();
        $allTypes = DB::table('type_products')->get();
        dd($allTypes);
        return view('admin.index', ['allProducts' => $allProducts, 'allTypes' => $allTypes]);
    }
}
