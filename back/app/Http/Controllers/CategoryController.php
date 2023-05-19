<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller{
    public function index(){return Category::all();}
    public function show($shop_id){return Category::where('shop_id', $shop_id)->get();}
    public function store(StorecategoryRequest $request){return Category::create($request->all());}
    public function update(UpdatecategoryRequest $request, Category $category){$category->update($request->all());return $category;}
    public function destroy(Category $category){$category->delete();return $category;}
}
