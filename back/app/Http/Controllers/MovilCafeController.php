<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MovilCafeController extends Controller
{
    public function import()
    {
        $categories = Category::where('shop_id', 2)->get();
        $products = Product::where('shop_id', 2)->with('category')->orderBy('category_id')->get();
        return response()->json([
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
