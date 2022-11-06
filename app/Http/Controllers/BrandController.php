<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('dashboard.brands.index',['brands'=>$brands]);
    }

    public function create(){
        return view('dashboard.brands.create');
    }

    public function store(Request $request){
        $request->validate([
            'brand_name' => ['required', 'string', 'min:2', 'max:100'],
            'status'     => ['required', 'in:0,1']
        ]);

        Brand::create([
            'brand_name' => $request->brand_name,
            'status'     => $request->status,
        ]);

        return back()->with('success', 'Brand has been created!');
    }

    public function edit(Brand $brand){
        return view('dashboard.brands.edit', ['brand'=>$brand]);
    }

    public function update(Request $request, Brand $brand){
        $request->validate([
            'brand_name' => ['required', 'string', 'min:2', 'max:100'],
            'status'        => ['required', 'in:0,1']
        ]);

        $brand->update([
            'brand_name' => $request->brand_name,
            'status'        => $request->status,
        ]);

        return back()->with('success', 'Brand has been updated!');
    }

    public function destroy(Brand $brand){
        $brand->delete();
        return back()->with('success', 'Brand has been deleted');
    }
}
