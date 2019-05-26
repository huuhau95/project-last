<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Image;
use App\Http\Requests\ProductRequest;
use App\Repositories\Repository;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use DB;
use File;

class ProductController extends Controller
{
    protected $productModel;
    protected $categoryModel;
    protected $imageModel;

    public function __construct(Product $productModel, Category $categoryModel, Image $imageModel)
    {
        $this->productModel = new Repository($productModel);
        $this->categoryModel = new Repository($categoryModel);
        $this->imageModel = new Repository($imageModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryModel->all();
        return view('admin.product_list', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if(empty($request->selling)){
            $request->selling = 0;
        }
        $product = $this->productModel->create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'brief' => $request->brief,
            'description' => $request->description,
            'discount' => $request->discount,
            'selling' => $request->selling,
            'size' => json_encode($request->size),
            'color' => json_encode($request->color),
        ]);
                if($request->hasFile('image')) {
                    if($product) {
                        foreach ($request->image as $photo) {

                            $filename = time() . '_' . $photo->getClientOriginalName();

                            $path = public_path(config('asset.image_path.product') . $filename);
                            Images::make($photo->getRealPath())->resize(600, 600)->save($path);
                            $this->imageModel->create([
                                'name' => $filename,
                                'product_id' => $product->id,
                            ]);
                        }
                    } else {
                        die("Upload ảnh không thành công. Vui lòng thử lại.");
                    }
                }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->with(['images' => function ($query) {
            $query->get();
        }])->findOrFail($id);

        return response($product, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if (Auth::user()->role_id == 2) {
            return Response::json(__('Bạn không phải admin'), 403);
        }
        if(empty($request->selling)){
            $request->selling = 0;
        }
        $product = $this->productModel->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'brief' => $request->brief,
            'description' => $request->description,
            'discount' => $request->discount,
            'selling' => $request->selling,
            'size' => json_encode($request->size),
            'color' => json_encode(array_filter($request->color)),
        ], $id);

        if($request->hasFile('image')) {
            if($product) {
            foreach ($request->image as $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();

                $path = public_path(config('asset.image_path.product') . $filename);
                Images::make($photo->getRealPath())->resize(600, 600)->save($path);
                $img =  $this->imageModel->create([
                        'name' => $filename,
                        'product_id' => $id,
                ]);
            }
            } else {
                die("Upload ảnh không thành công. Vui lòng thử lại.");
            }
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == 2) {
            return Response::json(__('Bạn không phải admin'), 403);
        }

       $this->productModel->delete($id);
    }

    public function getAllData()
    {
        $products = Product::with(['images' => function ($query) {
            $query->get();
        }])->with('category')->get();

        return Datatables::of($products)->make(true);
    }

    public function getCategorySelect()
    {
        $categories = Category::pluck('name', 'id');

        return Response::json($categories, 200);
    }

    public function destroy_image(Request $request){
        $id = $request->data_id;
        $image = Image::findOrFail($id);
        $path = public_path('images/products/' . $image->name);
        if (File::exists($path)) {
             unlink($path);
        }
        $image->delete();
        die(json_encode(array("status"=>true)));
    }
}
