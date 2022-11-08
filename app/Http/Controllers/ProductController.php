<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Product Resources list
     * 
     * @return Illuminate\Http\Response
     */
    public function index(){
        $products = Product::with('category', 'brand')->latest()->get();
        return view('dashboard.products.index', ['products'=>$products]);
    }

    /**
     * Product Resources Create
     * 
     * @return Illuminate\Http\Response
     */
    public function create(){
        $data = [
            'brands'=> Brand::latest('id')->where('status',1)->get(),
            'categories'=> Category::latest('id')->where('status',1)->get(),
        ];
        return view('dashboard.products.create',['data'=>$data]);
    }

    /**
     * Product Resources Store
     * 
     * @return Illuminate\Http\ProductRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(ProductRequest $request){
        $data = $request->except('_token');
        $data['product_slug'] = Str::slug($request->product_slug);

        // File Upload
        if ($request->hasFile('image')) {
            $product_image = $request->file('image');
            $imageExt = $product_image->getClientOriginalExtension();
            $imageUniqueName = md5(time().rand()).'.'.$imageExt;
            $product_image->move('products/images/', $imageUniqueName);

            $data['image'] = $imageUniqueName;
        }
        Product::create($data);

        return back()->with('success', 'Product Has been created!');
    }

    /**
     * Product Resources Update
     * 
     * @param App\Model\Product $products
     * @return Illuminate\Http\ProductRequest $request
     * @return Illuminate\Http\Response
     */
    public function edit(Product $product){
        $data = [
            'brands'=> Brand::latest('id')->where('status',1)->get(),
            'categories'=> Category::latest('id')->where('status',1)->get(),
        ];

        return view('dashboard.products.edit', ['data'=>$data, 'product'=>$product]);
    }

    /**
     * Product Resources Update
     * 
     * @param App\Model\Product $products
     * @return Illuminate\Http\ProductRequest $request
     * @return Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product){
        $data = $request->except('_token');
        $data['product_slug'] = Str::slug($request->product_slug);

        // File Upload
        if ($request->hasFile('image')) {
            if($product->image != null){
                file_exists('products/images/'.$product->image) ? unlink('products/images/'.$product->image) : false;
            }
            $product_image = $request->file('image');
            $imageExt = $product_image->getClientOriginalExtension();
            $imageUniqueName = md5(time().rand()).'.'.$imageExt;
            $product_image->move('products/images/', $imageUniqueName);

            $data['image'] = $imageUniqueName;
        }
        $product->update($data);


        return back()->with('success', 'Product has been updated!');
    }

    /**
     * Product Resources Destroy
     * 
     * @param App\Model\Product $product
     * @return Illuminate\Http\ProductRequest $request
     * @return Illuminate\Http\Response
     */
    public function destroy(Product $product){
        if($product->image != null){
            file_exists('products/images/'.$product->image) ? unlink('products/images/'.$product->image) : false;
        }

        $product->delete();

        return back()->with('success', 'Product has been Deleted!');
    }

    /**
     * Product Resources Destroy
     * 
     * @param App\Model\Product $product
     * @return Illuminate\Http\Response
     */
    public function show(Product $product){
        return view('dashboard.products.show', ['product'=>$product]);
    }

}