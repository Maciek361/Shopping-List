<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(): View
    // {
    //     $products = Products::all(); 
    //     return view('products.index', ['products' => $products]);
        
    // } --- to jest do blade

    public function index()
    {
        $products = Products::all();
        return response()->json(ProductResource::collection($products));
        
    }
    public function show($id)
    {
    //    return view('products', [
    //         'products' => Products::findOrFail($id)
    //     ]);
    $products = Products::findOrFail($id);
        return response()->json(new ProductResource($products));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
        
        ]);

        $products = Products::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
           
        ]);

        return response()->json(new ProductResource($products), 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $products = Products::find($id);

        if (!$products) {
            
            return response()->json(['message' => 'Nie znaleziono produktu'], 404);
        }

        return view('products.edit', ['Produkt' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $products = Products::find($id);

        if (!$products) {
            return response()->json(['message' => 'Nie znaleziono produktu'], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            // Dodaj inne reguły walidacji, jeśli to konieczne
        ]);

        $products->update([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            // Dodaj inne pola modelu Product, które chcesz zaktualizować
        ]);

        return response()->json(new ProductResource($products), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $products = Products::find($id);

        if (!$products) {
            return response()->json(['message' => 'Nie znaleziono produktu'], 404);
        }

        $products->delete();

        return response()->json(['message' => 'Produkt został usunięty'], 200);
    }
}
