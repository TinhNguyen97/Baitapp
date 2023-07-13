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
        $allProducts = DB::table('products')
            ->join('type_products', 'products.id_type', '=', 'type_products.id')
            ->select('products.*', 'type_products.name as tp_name', 'type_products.id as id_type')
            ->latest()
            ->paginate(5);
        $allTypes = DB::table('type_products')->get();
        // dd($allProducts);
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
                'name' => 'required',
                'id_type' => 'required',
                'description' => 'required',
                'unit_price' => 'required',
                'promotion_price' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'id_type.required' => 'Không được để trống.',
                'description.required' => 'Không được để trống.',
                'unit_price.required' => 'Không được để trống.',
                'promotion_price.required' => 'Không được để trống.'
            ]
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
        $dish = Products::find($id);

        abort_if(!$dish, 404);
        $request->validate(
            [
                'editName' => 'required',
                'editType' => 'required',
                'editPrice' => 'required',
                'editDescr' => 'required',
                'editPromotionPrice' => 'required'
            ],
            [
                'editName.required' => 'Tên không được để trống.',
                'editType.required' => 'Không được để trống.',
                'editPrice.required' => 'Không được để trống.',
                'editDescr.required' => 'Không được để trống.',
                'editPromotionPrice.required' => 'Không được để trống.'
            ]
        );
        if ($request->has('editImage')) {

            $file = $request->editImage;
            $ext = $request->editImage->extension();
            $file_name = time() . '-' . 'product' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->editName,
                'id_type' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice,
                'image' => $file_name
            ];
            Products::where('id', $id)->update($data);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            Products::where('id', $id)->update([
                'name' => $request->editName,
                'id_type' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice
            ]);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
    public function search(Request $request)
    {
        $allProducts = Products::where('name', 'like', '%' . $request->key . '%')->latest()->get();
        $allProductSearch = DB::table('products')
            ->join('type_products', 'products.id_type', '=', 'type_products.id')
            ->select('products.*', 'type_products.name as tp_name', 'type_products.id as id_type')
            ->where('products.name', 'like', '%' . $request->key . '%')
            ->latest()
            ->paginate(5);
        $allTypes = DB::table('type_products')->get();
        return view('products.search', [
            'allProductSearch' => $allProductSearch,
            'request' => $request,
            'allProducts' => $allProducts,
            'key' => $request->key,
            'allTypes' => $allTypes
        ]);
    }
    public function addSearch(Request $request)
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
                'name' => 'required',
                'id_type' => 'required',
                'description' => 'required',
                'unit_price' => 'required',
                'promotion_price' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'id_type.required' => 'Không được để trống.',
                'description.required' => 'Không được để trống.',
                'unit_price.required' => 'Không được để trống.',
                'promotion_price.required' => 'Không được để trống.'
            ]
        );


        Products::create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
    public function deleteSearch($id)
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
    public function putSearch(Request $request, $id)
    {
        // dd($request->all());
        $dish = Products::find($id);

        abort_if(!$dish, 404);
        if ($request->has('editImage')) {


            $file = $request->editImage;
            $ext = $request->editImage->extension();
            $file_name = time() . '-' . 'product' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->editName,
                'id_type' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice,
                'image' => $file_name
            ];
            Products::where('id', $id)->update($data);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            Products::where('id', $id)->update([
                'name' => $request->editName,
                'id_type' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice
            ]);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
}