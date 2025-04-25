<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;
use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getPostres(Request $request)
    {
        $user = $this->verifUser($request);

        
        if (!$user) {
            return response()->json(['error' => 'Token invàlid'], 401);
        }

        $postres = Api::getPostres();
        return response()->json($postres);
    }

    public function verifUser(Request $request)
    {
    
        $token = $request->header('Authorization') ?? $request->cookie('api_token');

        $user = Usuari::getUsuariByApiToken($token);


        if (!$user || $user->atoken_exp < time()) {
            return null;
        }

        return $user;
    }

    public function fiteredPostres(Request $request)
    {
        $user = $this->verifUser($request);

        if (!$user) {
            return response()->json(['error' => 'Token invàlid'], 401);
        }

        $filter = $request->path();
        $filter = implode('/', array_slice(explode('/', $filter), 1));

        if ($filter) {
            $postres = Api::getPostresFilter($filter);
            return response()->json($postres);
        } else {
            return response()->json(['error' => 'No hi ha filtre'], 400);
        }
    }

    public function setTokenCookie(Request $request)
    {
        $token = $request->input('api_token');
        if (!$token) {
            return response()->json(['error' => 'No hi ha cookie'], 400);
        }

        return response()->json(['message' => 'Token Aplicat'])
            ->cookie('api_token', $token, 60); 
    }
}
