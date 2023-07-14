<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }
}
