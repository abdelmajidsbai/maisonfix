<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{


    public function index(Request $request)
   {
    $categories = \App\Models\Category::all();

    $query = Product::query();

    // Filter by search
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    // Filter by category
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->get();

    return view('produits', compact('products', 'categories'));
}

   public function search(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->get();

    return view('partials.produits-list', compact('products'))->render();
}
    public function show($id)
    {
        $product =Product::with('category')->findOrFail($id);

    
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

    return view('products.show', compact('product', 'relatedProducts'));
    }
}
