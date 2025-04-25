<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Usuari;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PwdController extends Controller
{
    public function enviarCorreu(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $usuari = Usuari::getUsuari($request->email);

    $token = Usuari::generatePwdToken($usuari->correu);

    if (!$token) {
        return back()->with('error', 'No s\'ha pogut generar el token.');
    }

    Mail::to($usuari->correu)->send(new PasswordResetMail($request->email));

    return back()->with('success', 'T\'hem enviat un correu amb l\'enllaç per restablir la contrasenya.');
}

public function resetPwd($token)
{
    
    $token = request()->route('token');

    $usuari = Usuari::getUsuariByToken($token);

    if (!$usuari) {
        return redirect('/')->with('error', 'Token invàlid o caducat.');
    }

    $contrasenya = request('novacontrasenya');
    $contrasenyaConfirm = request('novaconf');

    if ($contrasenya !== $contrasenyaConfirm) {
        return redirect()->back()->with('error', 'Les contrasenyes no coincideixen.');
    }

    Usuari::changePwd($usuari->correu, $token, $contrasenya);

    return view('/login');
}

public function resetManualPwd(){

    $user = Auth::user();

    if (!$user) {
        return redirect('/')->with('error', 'Usuari no trobat.');
    }

    $oldPwd = request('contrasenya');
    $newPwd = request('contrasenyanova');
    $newPwdConfirm = request('contrasenyanovaconf');

    if ($newPwd !== $newPwdConfirm) {
        return redirect()->back()->with('error', 'Les contrasenyes no coincideixen.');
    }

    if (!Hash::check($oldPwd, $user->contrasenya)) {
        return redirect()->back()->with('error', 'La contrasenya antiga és incorrecta.');
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/', $newPwd)) {
        return redirect()->back()->with('error', 'La nova contrasenya no compleix els requisits de seguretat.');
    }

    Usuari::changeManualPwd($user->correu, $newPwd);
    return redirect('/logedHome')->with('success', 'La contrasenya s\'ha actualitzat correctament.');
}

}