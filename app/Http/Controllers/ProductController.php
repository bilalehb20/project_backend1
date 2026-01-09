<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category']);

        // Search
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand) {
            $query->where('brand_id', $request->brand);
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            // Special case: if category is "hoesjes", filter by both hoesjes categories
            if ($request->category === 'hoesjes') {
                $hoesjesCategoryIds = Category::whereIn('name', ['Aangepaste Hoesjes', 'Manga Editie & Meer'])->pluck('id');
                $query->whereIn('category_id', $hoesjesCategoryIds);
            } else {
                $query->where('category_id', $request->category);
            }
        }

        $products = $query->paginate(12);
        $brands = Brand::all();
        $categories = Category::all();

        return view('products.index', compact('products', 'brands', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['brand', 'category', 'likes']);
        $isLiked = auth()->check() && $product->likes()->where('user_id', auth()->id())->exists();

        return view('products.show', compact('product', 'isLiked'));
    }
}
