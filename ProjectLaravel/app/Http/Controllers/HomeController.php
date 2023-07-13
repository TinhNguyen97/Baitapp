<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slides;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slides::all();
        $newProducts = Products::orderByRaw('created_at DESC')->limit(4)->get();
        // dd($newProducts);
        // dd($newProducts);
        return view('home.index', [
            'slides' => $slides,
            'newProducts' => $newProducts
        ]);
    }
}
