<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;

class ProductController extends Controller
{
    public function index()
    {
        // echo public_path('uploads' . '\\' . '123');
        // die;
        // dd(Dish::all());
        $allProducts = DB::table('products')->join('type_products', 'products.id_type', '=', 'type_products.id')->select('products.*', 'type_products.name as tp_name', 'type_products.id as id_type')->get();
        $allTypes = DB::table('type_products')->get();
        return view('products.index', ['allProducts' => $allProducts, 'allTypes' => $allTypes]);
    }
    public function add(Request $request)
    {
        // dd($request->all());
        $file_name = null;
        if ($request->has('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'product' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $request->validate(
            [
                // 'name' => 'required|min:5'
                'name' => 'required'
            ],
            ['name.required' => 'Tên không được để trống.']
        );


        Products::create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
    public function delete($id)
    {

        $dish = Products::find($id);
        abort_if(!$dish, 404);
        $image = Products::select('image')->where('id', $id)->get();
        $fileImage = $image[0]['image'];
        if (file_exists('uploads' . '\\' . $fileImage)) {
            unlink('uploads' . '\\' . $fileImage);
        }
        Products::destroy($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function put(Request $request, $id)
    {
        // dd($request->all());
        $dish = Products::find($id);

        abort_if(!$dish, 404);
        if ($request->has('image')) {
            $file = $request->image;
            $file_name = rand() . $file->getClientoriginalName();
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->name,
                'id_type' => $request->type,
                'description' => $request->description,
                'unit_price' => $request->price,
                'promotion_price' => $request->promotionPrice,
                'image' => $file_name
            ];
            Products::where('id', $id)->update($data);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            Products::where('id', $id)->update([
                'name' => $request->name,
                'id_type' => $request->type,
                'description' => $request->description,
                'unit_price' => $request->price,
                'promotion_price' => $request->promotionPrice
            ]);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
}
