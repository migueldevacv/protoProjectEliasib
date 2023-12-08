<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            $token = $user->createToken(User::TOKEN_NAME)->accessToken;
            // dd($token);
            return response()->json([
                "message" => "User created successfully",
                "user" => $user,
                "token" => $token,
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
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                $token = $user->createToken(User::TOKEN_NAME)->accessToken;
                // dd($token);
                return response()->json([
                    "message" => "successfully logged in",
                    "token" => $token
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            "error" => [
                "message" => "Error iniciando sesion busquele padrino",
            ],
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
