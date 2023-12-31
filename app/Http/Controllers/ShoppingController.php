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

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
    
        $shopping = new Shopping([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'), //user ma byc brany z zalogowanego użytkownika (jak będzie passport)
        ]);
    
        $shopping->save();
        $shopping->users()->attach($request->input('user_id'));
        return response()->json(($shopping), 201);
    }
    public function update(Request $request, $id)
    {
        $shopping = Shopping::findOrFail($id);

        $request->validate([
            'name' => 'required|string',

       
        ]);
        $shopping->update([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
          
        ]);

        return response()->json(($shopping), 200);
    }
}
