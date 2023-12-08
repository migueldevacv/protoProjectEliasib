<?php

namespace App\Http\Controllers;

use App\Models\SalesDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->sale_id) {
            $saleDetail = SalesDetail::where("sale_id", $request->sale_id)
                ->with('sale')
                ->get();

            return response()->json([
                "message" => User::RETURN_DATA_OK,
                "data" => $saleDetail,
            ], Response::HTTP_CREATED);
        } else {

            $saleDetail = SalesDetail::with('sale')->get();

            return response()->json([
                "message" => User::RETURN_DATA_OK,
                "data" => $saleDetail,
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'sale_id' => 'required',
            'products' => 'required|array',
            'products.*.product_branche_id' => 'required',
            'products.*.quantity' => 'required',
        ]);
        if ($validator->fails()) {
            
            return response()->json([
                "error" => [
                    'message' => $validator->errors()->first(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
        $products = collect($request->products)->map(fn($p) => [
            "sale_id" => $request->sale_id,
            "product_branche_id" => collect($p)['product_branche_id'],
            "quantity" => collect($p)['quantity']
        ]);

        // dd($products);

        foreach ($products as $product) {
            SalesDetail::create($product);
        }
        
        return response()->json([
            "message" => User::RETURN_DATA_OK,
            "data" => true,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesDetail $salesDetail)
    {
        //
    }
}
