<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\User;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $categories = Category::whereNull('softDelete')->get();
        return response()->json(['category' => $categories], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|min:2|max:10',
            'title' => 'required|min:2|max:10',
            'description' => 'required|min:10|max:500'
        ]);
        
        $category = Category::create([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description,
            'idParentCategory' => $request->idParentCategory
        ]);

        return response()->json(['user' => "User Created Successfully"], 200);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category], 200);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['user' => $category], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return response()->json(['user' => $category,'message' => 'Category Updated Successfully'], 200);
    }

    public function destroy($id)
    {
        Category::where('id', $id)
        ->update(['softDelete' => true]);
        return response()->json(['category' => "",'message' => 'Category Deleted Successfully'], 200);
    }
}
