<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Statistical;
use App\Models\Statisticals;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function index()
    {

        $statisticals = Statistical::all();
        // dd($statisticals);
        return view('statisticals.index', ['statisticals' => $statisticals]);
    }
}
