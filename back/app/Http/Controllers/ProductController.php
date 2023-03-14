<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($shop_id)
    {
        //
        return  DB::table('products')
            ->select('products.*')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.shop_id',$shop_id)
            ->get();

        return Product::with('category')
        ->whereIn('category_id',$valor)->get();
    }
    public function productSFilter($category_id)
    {
        return Product::where('category_id',$category_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return $product;
    }
}
