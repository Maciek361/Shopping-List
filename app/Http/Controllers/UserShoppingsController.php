<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\ShoppingResource;

use Illuminate\Http\Request;

class UserShoppingsController extends Controller
{
    public function index(string $id)
    {
        $user = User::with(['shoppings'])->find($id);
        $shoppings = $user->shoppings;

        return response()->json(ShoppingResource::collection($shoppings), 200);
    }

    public function destroy(string $userId, string $shoppingId)
    {
        $user = User::with(['shoppings'])->find($userId);
        $shoppings = $user->shoppings;

        $shopping = $shoppings->find($shoppingId);

        if (!$shopping) {
            return response()->json(['message' => 'Nie odnaleziono listy o podanym id'], 422);
        }

        $user->shoppings()->detach($shoppingId);

        return response()->json(['message' => 'Uzytkownik odlaczony od listy'], 200);
    }
}
