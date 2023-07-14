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
    public function search(Request $request)
    {
        $allProductSearch = DB::table('products')
            ->where('products.name', 'like', '%' . $request->key . '%')
            ->orWhere('products.unit_price', $request->key)
            ->latest()
            ->paginate(8);
        $allProducts = Products::where('name', 'like', '%' . $request->key . '%')
            ->orWhere('products.unit_price', $request->key)
            ->latest()->get();
        // dd($allProductSearch);
        // dd($newProducts);
        return view(
            'home.search',
            [
                'allProductSearch' => $allProductSearch,
                'allProducts' => $allProducts,
                'request' => $request,
                'key' => $request->key
            ]
        );
    }
    public function typeSearch(Request $request, $idType)
    {
        $allProductSearch = Products::where('id_type', $idType)->paginate(8);
        $allProducts = Products::where('id_type', $idType)->get();
        return view(
            'home.producttype',
            [
                'allProductSearch' => $allProductSearch,
                'allProducts' => $allProducts,
                'request' => $request
            ]
        );
    }
    public function details($id)
    {
        $product = Products::find($id);
        $relativeProducts = Products::where('id_type', $product->id_type)->paginate(3);
        return view('products.detail', ['product' => $product, 'relativeProducts' => $relativeProducts]);
    }
}
