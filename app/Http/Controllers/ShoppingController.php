<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShoppingResource;
use App\Models\Shopping;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    public function index()
    {
        return response()->json(Shopping::all());
    }

    public function show(string $id)
    {
        $user = auth()->user();
        $shopping = Shopping::with(['users', 'products'])->find($id);

        $isContributor = $shopping->users->contains(User::find($user->id));

        if ($user->id != $shopping->user_id || !$isContributor) {
            return response()->json(['message' => 'user is not a creator nor contributor of a list'], 403);
        }

        return response()->json(new ShoppingResource($shopping));
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = auth()->user()->id; //wyciaganie aktualnie zalogowanego uzytkownika

        $request->validate([
            'name' => 'required|string',
        ]);

        $shopping = new Shopping([
            'name' => $request->input('name'),
            'user_id' => $userId,

        ]);

        $shopping->save();
        $shopping->users()->attach($userId);
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

    public function destroy($id)
    {
        $shopping = Shopping::findOrFail($id);
        $shopping->users()->detach();
        $shopping->products()->detach($id);
        $shopping->delete();

        return response()->json(['message' => 'Lista została usunięta'], 200);
    }

    public function detachProduct($listId, $productId)
    {
        $shopping = Shopping::findOrFail($listId);
        $shopping->products()->detach($productId);

        return response()->json(['message' => 'Produkt został odłączony z listy'], 200);
    }

    public function attachProduct($shoppingId, $productId)
    {
        $shopping = Shopping::findOrFail($shoppingId);

        if ($shopping->products->contains(Product::find($productId))) {
            return response()->json(['message' => 'Produkt juz znajduje sie ne liscie'], 422);
        }

        $shopping->products()->attach($productId);

        return response()->json(['message' => 'Produkt został dodany do listy'], 200);
    }
    public function updateQuantity(Request $request, $shoppingId, $productId)
    {
        $shopping = Shopping::findOrFail($shoppingId);
        $quantity = $request->input('quantity');

        if (!$shopping) {
            return response()->json(['message' => 'Nie odnaleziono listy o podanym ID'], 400);
        }

        $updatedRows = DB::table('product_shopping')->where('shopping_id', $shoppingId)->where('product_id', $productId)->update(['quantity' => $quantity]);

        if ($updatedRows == 0) {
            return response()->json(['message' => 'Operacja nie powiodła się'], 400);
        }

        return response()->json($shopping, 200);
    }
    public function updateChecked(Request $request, $shoppingId, $productId)
    {
        $shopping = Shopping::findOrFail($shoppingId);
        $checked = $request->input('checked');

        if (!$shopping) {
            return response()->json(['message' => 'Nie odnaleziono listy o podanym ID'], 400);
        }

        $updatedRows = DB::table('product_shopping')->where('shopping_id', $shoppingId)->where('product_id', $productId)->update(['checked' => $checked]);

        if ($updatedRows == 0) {
            return response()->json(['message' => 'Operacja nie powiodła się'], 400);
        }

        return response()->json($shopping, 200);
    }
}
