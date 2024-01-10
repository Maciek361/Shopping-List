<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');

        $searchParam = $request->query('name');

        if ($searchParam) {
            $products = Product::where('name', 'like', '%' . $searchParam . '%')->get();
        } else {
            $products = Product::with(['category'])->get();
        }

        return response()->json(ProductResource::collection($products));
    }

    public function show($id)
    {

        $products = Product::with('category')->findOrFail($id);

        return response()->json(new ProductResource($products));
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);

        $products = Product::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),

        ]);

        return response()->json(new ProductResource($products), 201);
    }


    public function edit($id): View
    {
        $products = Product::find($id);

        if (!$products) {

            return response()->json(['message' => 'Nie znaleziono produktu'], 404);
        }

        return view('products.edit', ['Produkt' => $products]);
    }


    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);

        $products->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),

        ]);

        return response()->json(new ProductResource($products), 200);
    }

    public function destroy($id)
    {
        $products = Product::findOrFail($id);

        $products->delete();

        return response()->json(['message' => 'Produkt został usunięty'], 200);
    }

    public function addToShoppingList(Request $request, $productId, $shoppingListId)
    {
        // Dodaj logikę do dodawania produktu do listy zakupów
        // Użyj modelu ShoppingList i list_product

        return response()->json(['message' => 'Produkt został dodany do listy zakupów'], 200);
    }
}
