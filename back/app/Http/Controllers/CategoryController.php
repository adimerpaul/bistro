<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller{
    public function index(){return category::all();}
    public function show($shop_id){return category::where('shop_id', $shop_id)->get();}
    public function store(StorecategoryRequest $request){return category::create($request->all());}
    public function update(UpdatecategoryRequest $request, category $category){$category->update($request->all());return $category;}
    public function destroy(category $category){$category->delete();return $category;}
}
