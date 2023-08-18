<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeProductController extends Controller
{
    public function index()
    {
        $allTypes = DB::table('type_products')->latest()->paginate(5);
        // dd($allTypes);
        return view('types.index', ['allTypes' => $allTypes]);
    }
    public function add(Request $request)
    {
        // dd($request->all());
        $file_name = null;
        if ($request->has('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'type' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'description.required' => 'Không được để trống.'
            ]
        );


        TypeProduct::create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
    public function put(Request $request, $id)
    {
        $type = TypeProduct::find($id);

        abort_if(!$type, 404);
        $request->validate(
            [
                'editName' => 'required',
                'editDescr' => 'required',
            ],
            [
                'editName.required' => 'Tên không được để trống.',
                'editDescr.required' => 'Không được để trống.'
            ]
        );
        if ($request->has('editImage')) {

            $file = $request->editImage;
            $ext = $request->editImage->extension();
            $file_name = time() . '-' . 'type' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->editName,
                'description' => $request->editDescr,
                'image' => $file_name
            ];
            TypeProduct::where('id', $id)->update($data);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            TypeProduct::where('id', $id)->update([
                'name' => $request->editName,
                'description' => $request->editDescr
            ]);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
    public function delete($id)
    {

        $product = TypeProduct::find($id);
        abort_if(!$product, 404);
        $image = TypeProduct::select('image')->where('id', $id)->get();
        $fileImage = $image[0]['image'];
        if (file_exists('uploads' . '\\' . $fileImage)) {
            unlink('uploads' . '\\' . $fileImage);
        }
        TypeProduct::destroy($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function search(Request $request)
    {
        $allTypes = TypeProduct::where('name', 'like', '%' . $request->key . '%')->latest()->get();
        // dd(count($allTypes));
        $allTypeSearch = DB::table('type_products')
            ->where('type_products.name', 'like', '%' . $request->key . '%')
            ->latest()
            ->paginate(5);
        return view('types.search', [
            'allTypeSearch' => $allTypeSearch,
            'request' => $request,
            'keySearch' => $request->key,
            'allTypes' => $allTypes
        ]);
    }
    public function deleteSearch($id)
    {

        $typeProduct = TypeProduct::find($id);
        abort_if(!$typeProduct, 404);
        $image = TypeProduct::select('image')->where('id', $id)->get();
        $fileImage = $image[0]['image'];
        if (file_exists('uploads' . '\\' . $fileImage)) {
            unlink('uploads' . '\\' . $fileImage);
        }
        TypeProduct::destroy($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function putSearch(Request $request, $id)
    {
        // dd($request->all());
        $typeProduct = TypeProduct::find($id);

        abort_if(!$typeProduct, 404);
        if ($request->has('editImage')) {


            $file = $request->editImage;
            $ext = $request->editImage->extension();
            $file_name = time() . '-' . 'type' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->editName,
                'description' => $request->editDescr,
                'image' => $file_name
            ];
            TypeProduct::where('id', $id)->update($data);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            TypeProduct::where('id', $id)->update([
                'name' => $request->editName,
                'description' => $request->editDescr
            ]);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
    public function addSearch(Request $request)
    {
        // dd($request->all());
        $file_name = null;
        if ($request->has('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'type' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'description.required' => 'Không được để trống.'
            ]
        );


        TypeProduct::create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
}
