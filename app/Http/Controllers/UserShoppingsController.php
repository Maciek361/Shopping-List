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
}
