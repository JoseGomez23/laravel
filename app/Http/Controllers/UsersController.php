<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    
    public static function bdUsers()
    {
        $users = Usuari::getAllUsers();
        return view('bdUsers', compact('users'));
    }

    public function updateProfile(Request $request)
    {
        
        $user = Auth::user();
        
        $user->nomusuari = $request->nouusuari;

        if($user->google_id != null){

            $user->correu = $request->noucorreu;
        }  
        $user->save();

        return redirect('/userProfile')->with('success', 'Perfil actualitzat.');
    }

}
