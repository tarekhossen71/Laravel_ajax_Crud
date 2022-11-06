<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

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
     * @param Illuminate\Http\CategoryRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(CategoryRequest $request){

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
     * @param Illuminate\Http\CategoryRequest $request
     * @return Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category){

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
