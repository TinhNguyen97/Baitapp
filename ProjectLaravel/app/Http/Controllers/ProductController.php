<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\TypeProduct;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\TypeProduct\TypeProductServiceInterface;

class ProductController extends Controller
{
    private $productService;
    private $typeProductService;
    private $commentService;
    public function __construct(
        ProductServiceInterface $productService,
        TypeProductServiceInterface $typeProductService,
        CommentServiceInterface $commentService
    ) {
        $this->productService = $productService;
        $this->typeProductService = $typeProductService;
        $this->commentService = $commentService;
    }
    public function index()
    {
        $allProducts = $this->productService->getAllProductAndType();
        $allTypes = $this->typeProductService->all();
        return view('products.index', ['allProducts' => $allProducts, 'allTypes' => $allTypes]);
    }
    public function add(Request $request)
    {
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
                'type_id' => 'required',
                'description' => 'required',
                'unit_price' => 'required',
                'promotion_price' => 'required',
                'product_quantity' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'type_id.required' => 'Không được để trống.',
                'description.required' => 'Không được để trống.',
                'unit_price.required' => 'Không được để trống.',
                'promotion_price.required' => 'Không được để trống.',
                'product_quantity.required' => 'Không được để trống.'
            ]
        );


        $this->productService->create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
    public function delete($id)
    {

        $product = $this->productService->find($id);
        abort_if(!$product, 404);
        $image = $product->image;
        if (file_exists('uploads' . '\\' . $image)) {
            unlink('uploads' . '\\' . $image);
        }
        $this->productService->delete($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function put(Request $request, $id)
    {
        $product = $this->productService->find($id);

        abort_if(!$product, 404);
        $request->validate(
            [
                'editName' => 'required',
                'editType' => 'required',
                'editPrice' => 'required',
                'editDescr' => 'required',
                'editPromotionPrice' => 'required',
                'editQuantity' => 'required'
            ],
            [
                'editName.required' => 'Tên không được để trống.',
                'editType.required' => 'Không được để trống.',
                'editPrice.required' => 'Không được để trống.',
                'editDescr.required' => 'Không được để trống.',
                'editPromotionPrice.required' => 'Không được để trống.',
                'editQuantity.required' => 'Không được để trống.'
            ]
        );
        if ($request->has('editImage')) {

            $file = $request->editImage;
            $ext = $request->editImage->extension();
            $file_name = time() . '-' . 'product' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->editName,
                'type_id' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice,
                'product_quantity' => $request->editQuantity,
                'image' => $file_name,
                'is_active' => $request->is_active
            ];
            $this->productService->update($data, $id);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            $this->productService->update([
                'name' => $request->editName,
                'type_id' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice,
                'product_quantity' => $request->editQuantity,
                'is_active' => $request->is_active
            ], $id);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
    public function search(Request $request)
    {
        $allProducts = $this->productService->searchByNameOrPrice($request);
        $allProductSearch = $this->productService->getAllSearch($request);
        $allTypes = $this->typeProductService->all();
        return view('products.search', [
            'allProductSearch' => $allProductSearch,
            'request' => $request,
            'allProducts' => $allProducts,
            'keySearch' => $request->key,
            'allTypes' => $allTypes
        ]);
    }
    public function addSearch(Request $request)
    {
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
                'type_id' => 'required',
                'description' => 'required',
                'unit_price' => 'required',
                'promotion_price' => 'required',
                'product_quantity' => ' required'
            ],
            [
                'name.required' => 'Tên không được để trống.',
                'type_id.required' => 'Không được để trống.',
                'description.required' => 'Không được để trống.',
                'unit_price.required' => 'Không được để trống.',
                'promotion_price.required' => 'Không được để trống.',
                'product_quantity.required' => 'Không được để trống.'
            ]
        );


        $this->productService->create(array_merge($request->all(), [
            'image' => $file_name
        ]));

        return back()->with(['isCreateSuccess' => true]);
    }
    public function deleteSearch($id)
    {

        $product = $this->productService->find($id);
        abort_if(!$product, 404);
        $image = $product->image;
        if (file_exists('uploads' . '\\' . $image)) {
            unlink('uploads' . '\\' . $image);
        }
        $this->productService->delete($id);
        return back()->with(['isDeleteSuccess' => true]);
    }
    public function putSearch(Request $request, $id)
    {
        // dd($request->all());
        $product = $this->productService->find($id);

        abort_if(!$product, 404);
        if ($request->has('editImage')) {


            $file = $request->editImage;
            $ext = $request->editImage->extension();
            $file_name = time() . '-' . 'product' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $data = [
                'name' => $request->editName,
                'type_id' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice,
                'product_quantity' => $request->editQuantity,
                'image' => $file_name,
                'is_active' => $request->is_active
            ];
            $this->productService->update($data, $id);
            return back()->with(['isUpdateSuccess' => true]);
        } else {
            // dd($request->all());
            $this->productService->update([
                'name' => $request->editName,
                'type_id' => $request->editType,
                'description' => $request->editDescr,
                'unit_price' => $request->editPrice,
                'promotion_price' => $request->editPromotionPrice,
                'product_quantity' => $request->editQuantity,
                'is_active' => $request->is_active
            ], $id);
            return back()->with(['isUpdateSuccess' => true]);
        }
    }
    public function details($id)
    {
        $product = $this->productService->find($id);
        $allProducts = $this->productService->getAllByTypeId($product->type_id);
        $relativeProducts = $this->productService->getAllRelativeProducts($product->type_id)->paginate(3);
        $comments = $this->commentService->getAllByProductId($id);
        return view('products.detail', [
            'product' => $product,
            'relativeProducts' => $relativeProducts,
            'allProducts' => $allProducts,
            'comments' => $comments
        ]);
    }
}
