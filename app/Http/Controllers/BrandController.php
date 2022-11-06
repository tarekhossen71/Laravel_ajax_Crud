<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Brand Resource List
     * 
     * @return Illuminate\Http\Response
     */
    public function index(){
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('dashboard.brands.index',['brands'=>$brands]);
    }

    /**
     * Brand Resource Create
     * 
     * @return Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.brands.create');
    }

    /**
     * Brand Resource Store
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
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

    /**
     * Brand Resource Edit
     * 
     * @param App\Model\Brand $brand
     * @return Illuminate\Http\Response
     */
    public function edit(Brand $brand){
        return view('dashboard.brands.edit', ['brand'=>$brand]);
    }

    /**
     * Brand Resource Update
     * 
     * @param App\Model\Brand $brand
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
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

    /**
     * Brand Resource Destroy
     * 
     * @param App\Model\Brand $brand
     * @return Illuminate\Http\Response
     */
    public function destroy(Brand $brand){
        $brand->delete();
        return back()->with('success', 'Brand has been deleted');
    }
}
