<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Dodaj import dla klasy Auth
use App\Models\ShoppingList; // Dodaj import dla modelu ShoppingList
use App\Models\Product; // Dodaj import dla modelu Product

class ShoppingListController extends Controller
{

    public function index()
    {
        // $user = Auth::user();
        $shoppingLists = ShoppingList::all();

        return response()->json($shoppingLists);
    }

    public function show($id)
    {
        // $user = Auth::user();
        $shoppingList = ShoppingList::findOrFail($id);

        return response()->json($shoppingList);
    }


 
}
