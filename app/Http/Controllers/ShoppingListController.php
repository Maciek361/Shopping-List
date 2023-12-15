<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ShoppingListController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $shoppingLists = ShoppingList::when($request->input('user_id'), function ($query) use ($request) {
            return $query->where('user_id', $request->input('user_id'));
        })->with('user')->get();

        return response()->json($shoppingLists);
    }

    public function show($id): JsonResponse
    {
        $shoppingList = ShoppingList::with('user')->findOrFail($id);
        return response()->json($shoppingList);
    }
}
