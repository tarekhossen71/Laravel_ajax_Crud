<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('dashboard.products.index');
    }

    public function create(){
        $data = [
            'brands'=> Brand::latest('id')->where('status',1)->get(),
            'categories'=> Category::latest('id')->where('status',1)->get(),
        ];
        return view('dashboard.products.create',['data'=>$data]);
    }
}
