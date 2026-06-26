<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create() {
        return view('dashboard.categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|string',
            'slug'=>'required|string|unique:categories',
            'image'=>'nullable|image'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->save();
        return redirect()->route('dashboard.categories.index')->with('success','Catégorie ajoutée');
    }

    public function edit(Category $category){
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name'=>'required|string',
            'slug'=>'required|string|unique:categories,slug,'.$category->id,
            'image'=>'nullable|image'
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->save();
        return redirect()->route('dashboard.categories.index')->with('success','Catégorie modifiée');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success','Catégorie supprimée');
    }
}
