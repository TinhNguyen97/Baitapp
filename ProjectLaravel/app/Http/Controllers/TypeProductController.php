<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use App\Services\TypeProduct\TypeProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeProductController extends Controller
{
    private $typeProductService;
    public function __construct(TypeProductServiceInterface $typeProductService)
    {
        $this->typeProductService = $typeProductService;
    }
    public function index()
    {
        $allTypes = $this->typeProductService->getAllPaginate();
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


        $this->typeProductService->create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
    public function put(Request $request, $id)
    {
        $type = $this->typeProductService->find($id);

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
            $this->typeProductService->update($data, $id);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            $this->typeProductService->update([
                'name' => $request->editName,
                'description' => $request->editDescr
            ], $id);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
    public function delete($id)
    {

        $product = $this->typeProductService->find($id);
        abort_if(!$product, 404);
        $image = $product->image;
        if (file_exists('uploads' . '\\' . $image)) {
            unlink('uploads' . '\\' . $image);
        }
        $this->typeProductService->delete($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function search(Request $request)
    {
        $allTypes = $this->typeProductService->allSearch($request);
        $allTypeSearch = $this->typeProductService->getAllByName($request->key);
        return view('types.search', [
            'allTypeSearch' => $allTypeSearch,
            'request' => $request,
            'keySearch' => $request->key,
            'allTypes' => $allTypes
        ]);
    }
    public function deleteSearch($id)
    {

        $typeProduct = $this->typeProductService->find($id);
        abort_if(!$typeProduct, 404);
        $image = $this->typeProductService->find($id)->image;
        if (file_exists('uploads' . '\\' . $image)) {
            unlink('uploads' . '\\' . $image);
        }
        $this->typeProductService->delete($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function putSearch(Request $request, $id)
    {
        // dd($request->all());
        $typeProduct = $this->typeProductService->find($id);

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
            $this->typeProductService->update($data, $id);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            $this->typeProductService->update([
                'name' => $request->editName,
                'description' => $request->editDescr
            ], $id);
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


        $this->typeProductService->create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
}
