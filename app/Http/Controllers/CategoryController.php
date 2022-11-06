<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Category Resource List
     * 
     * @return Illuminate\Http\Response
     */
    public function index(){
        $categories = Category::orderBy('id', 'desc')->get();
        return view('dashboard.categories.index',['categories'=>$categories]);
    }

    /**
     * Category Resource Create
     * 
     * @return Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.categories.create');
    }

    /**
     * Category Resource Store
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'category_name' => ['required', 'string', 'min:2', 'max:100'],
            'status'        => ['required', 'in:0,1']
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'status'        => $request->status,
        ]);

        return back()->with('success', 'Category has been created!');
    }

    /**
     * Category Resource Edit
     * 
     * @param App\Model\Category $category
     * @return Illuminate\Http\Response
     */
    public function edit(Category $category){
        return view('dashboard.categories.edit', ['category'=>$category]);
    }

    /**
     * Category Resource Update
     * 
     * @param App\Model\Category $category
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, Category $category){
        $request->validate([
            'category_name' => ['required', 'string', 'min:2', 'max:100'],
            'status'        => ['required', 'in:0,1']
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'status'        => $request->status,
        ]);

        return back()->with('success', 'Category has been updated!');
    }

    /**
     * Category Resource Destroy
     * 
     * @param App\Model\Category $category
     * @return Illuminate\Http\Response
     */
    public function destroy(Category $category){
        $category->delete();
        return back()->with('success', 'Category has been deleted');
    }
}
