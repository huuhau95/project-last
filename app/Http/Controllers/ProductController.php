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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productModel->create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brif' => $request->brif,
            'description' => $request->description,
            'discount' => $request->discount,

        ]);
        //save image
        $image = $request->file('image');

        $filename = $product->name . '_' . $image->getClientOriginalName();

        $path = public_path(config('asset.image_path.product') . $filename);

        Images::make($image->getRealPath())->resize(600, 600)->save($path);

        $this->imageModel->create([
            'name' => $filename,
            'product_id' => $product->id,
            'active' => 1,
        ]);
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
            $query->where('active', 1)->get();
        }])->findOrFail($id);

        return response($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            return Response::json(__('You are not admin'), 403);
        }

        $this->productModel->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brief' => $request->brief,
            'description' => $request->description,
            'discount' => $request->discount,
        ], $id);

        $image = $request->file('image');

        if ($image != null) {

            $filename = $request->name . '_' . $image->getClientOriginalName();

            $path = public_path('images/products/' . $filename);

            Images::make($image->getRealPath())->resize(600, 600)->save($path);

            $img = $this->imageModel->create([
                'name' => $filename,
                'product_id' => $id,
                'active' => 1,
            ]);

            Image::where('product_id', '=', $id)->whereNotIn('id', [$img->id])->update(['active' => 0]);
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
            return Response::json(__('You are not admin'), 403);
        }

       $this->productModel->delete($id);
    }

    public function getAllData()
    {
        $products = Product::with(['images' => function ($query) {
            $query->where('active', 1)->get();
        }])->with('category')->get();

        return Datatables::of($products)->make(true);
    }

    public function getCategorySelect()
    {
        $categories = Category::pluck('name', 'id');

        return Response::json($categories, 200);
    }
}
