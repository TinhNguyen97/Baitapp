<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dish;

class AdminController extends Controller
{

    public function index()
    {
        // dd(Dish::all());
        $allProducts = DB::table('products')->join('type_products', 'products.id_type', '=', 'type_products.id')->select('products.*', 'type_products.name as tp_name')->get();
        $allTypes = DB::table('type_products')->get();
        // dd($allTypes);
        return view('admin.index', ['allProducts' => $allProducts, 'allTypes' => $allTypes]);
    }
    // public function layoutAdmin()
    // {
    //     return view('admin.index');
    // }
    public function add(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5'
            ],
            ['name.required' => 'Tên không được để trống.']
        );
        $dataInsert = [
            'name' => $request->name
        ];

        Dish::create($dataInsert);

        return back()->with(['isCreateSuccess' => true]);
    }
    public function delete($id)
    {
        Dish::destroy($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function put(Request $request, $id)
    {
        $dish = Dish::find($id);

        abort_if(!$dish, 404);
        $dataInsert = [
            'name' => $request->name
        ];
        Dish::where('id', $id)->update($dataInsert);
        return back()->with(['isUpdateSuccess' => true]);
    }
}