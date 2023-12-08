<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        
        return response()->json([
            "message" => User::RETURN_DATA_OK,
            "data" => $product,
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $prodData = $request->all();
            $prodData["status"] = true;
            $product = Product::create($prodData);
            
            return response()->json([
                "message" => User::RETURN_DATA_OK,
                "data" => $product,
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => [
                    "message" => $th->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);
            $product->update($request->all());
            $product->save();
            
            return response()->json([
                "message" => User::RETURN_DATA_OK,
                "data" => $product,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => [
                    "message" => $th->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
