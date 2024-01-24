<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(Category::all());
    }
    public function show($id)
    {

        $category = Category::findOrFail($id);

        return response()->json(($category), 200);
    }
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'category_name' => 'required|string',

        ]);

        $category = Category::create([
            'category_name' => $request->input('category_name'),

        ]);

        return response()->json(($category), 201);

    }
}
