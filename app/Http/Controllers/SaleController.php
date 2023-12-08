<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sale = Sale::orderBy("id", "desc")
        ->get();
        
        return response()->json([
            "message" => User::RETURN_DATA_OK,
            "data" => $sale,
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $sale = $request->all();
            $sale = Sale::create($sale);
            
            return response()->json([
                "message" => User::RETURN_DATA_OK,
                "data" => $sale,
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
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $sale = Sale::find($id);
            $sale->update($request->all());

            return response()->json([
                "message" => User::RETURN_DATA_OK,
                "data" => $sale,
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
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
