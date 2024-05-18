<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credenciais = $request->all(['email', 'password']);
        
        $token = auth('api')->attempt($credenciais);
        if(!$token) {
            return response()->json(['erro' => 'Email ou senha invalidos, tente novamente!'], 403);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout() {
        auth('api')->logout();

        return response()->json(['msg' => 'O logout foi realizado com sucesso!'], 403);
    }

    public function refresh() {
        $token = auth('api')->refresh();

        return response()->json(['token' => $token], 401);
    }

    public function me() {
        return auth()->user();
    }
}