<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function index()
    {
        return response()->json(Shopping::all());
    }

    public function show(string $id)
    {
        return response()->json(Shopping::with(['users', 'products'])->find($id));
    }
}
