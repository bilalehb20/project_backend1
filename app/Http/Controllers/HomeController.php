<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get 6 unique featured products (bestsellers or newest) - no duplicates
        $featuredProducts = Product::with(['brand', 'category'])
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->take(6)
            ->get();
        
        // Get brands (smartphone brands) - exclude generic ones, limit to 8 main brands
        $brands = Brand::whereNotIn('name', ['Other', 'Generic', 'Custom'])
            ->orderBy('name')
            ->take(8)
            ->get();
        
        // Get featured product (latest/newest) for each brand as thumbnail
        $brandsWithProducts = $brands->map(function ($brand) {
            $featuredProduct = Product::where('brand_id', $brand->id)
                ->whereHas('category', function($q) {
                    $q->where('name', 'Smartphones');
                })
                ->orderBy('created_at', 'desc')
                ->first();
            
            $brand->featured_product = $featuredProduct;
            return $brand;
        });
        
        // Get categories: Accessoires and Aangepaste Hoesjes only
        $categories = Category::whereIn('name', ['Aangepaste Hoesjes', 'Accessoires'])->get();
        
        // Get featured product for each category
        $categoriesWithProducts = $categories->map(function ($category) {
            $featuredProduct = Product::where('category_id', $category->id)
                ->orderBy('created_at', 'desc')
                ->first();
            
            $category->featured_product = $featuredProduct;
            return $category;
        });

        // Get 3 latest news items
        $latestNews = News::orderBy('published_at', 'desc')->take(3)->get();

        return view('home', compact('featuredProducts', 'brandsWithProducts', 'categoriesWithProducts', 'latestNews'));
    }
}
