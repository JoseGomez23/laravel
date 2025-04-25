<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'postres';
    
    static function getPostres(){

        return Api::all();
    }

    static function getPostresFilter($filter){

        return Api::where('titol', 'like', '%'.$filter.'%')->get();
    }

    static function generateApiToken($correu){
        
        $user = Usuari::where('correu', $correu)->first(); 
        if ($user) {
            $token = bin2hex(random_bytes(16)); 
            $tokenExp = time() + 3600; // 1 hour expiration
            $user->atoken_exp = $tokenExp; // Store expiration time
            $user->api_token = $token; 
            $user->save();
            return $token;
        }
        return null;

    }

}
