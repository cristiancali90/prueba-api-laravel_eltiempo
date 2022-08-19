<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

//se importa la clase recurso para personalizar la respuesta
use App\Http\Resources\V1\ProductResource;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validacion de la peticion
        $request->validate([
            'title' => 'required',
            'price' => 'required|integer|gt:0',
            'description' => 'required',
            'category_id' => 'required|integer|gt:0',
        ]);


        $product = new Product;
        $product->title = $request->title; //requerido
        $product->price = $request->price; // mayor a cero (entero)
        $product->description = $request->description; //requerido
        $product->category_id = $request->category_id; //requerido mayor a cero (entero)
        $product->save();

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'status' => 201
        ], 201); //status de creación
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        // Validacion de la peticion
        $request->validate([
            'title' => 'required',
            'price' => 'required|integer|gt:0',
            'description' => 'required',
            'category_id' => 'required|integer|gt:0',
        ]);

        $product = Product::findOrFail($request->id);

        $product->title = $request->title; //requerido
        $product->price = $request->price; // mayor a cero (entero)
        $product->description = $request->description; //requerido
        $product->category_id = $request->category_id; //requerido mayor a cero (entero)

        $product->save();

        return $product;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204); //status de no content 
    }
}
