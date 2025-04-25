<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuaris'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'correu', 'contrasenya','nomusuari' // Campos que se pueden asignar masivamente
    ];

    protected $hidden = [
        'contrasenya', 'remember_token', // Ocultar estos campos al serializar
    ];

    public $timestamps = false; // Disable automatic timestamps

    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    
    static function getUsuari($correu){

        return Usuari::where('correu', $correu)->first();

    }

    static function createUsuari($correu, $password, $nomusuari){

        $user = new Usuari();
        $user->correu = $correu;
        $user->nomusuari = $nomusuari;
        $user->contrasenya = bcrypt($password);
        $user->save();
    }

    static function createGoogleUsuari($correu, $nomusuari, $google_id){

        $user = new Usuari();
        $user->correu = $correu;
        $user->nomusuari = $nomusuari;
        $user->google_id = $google_id;
        $user->save();
    }

    public static function generatePwdToken($correu){
        
        $user = Usuari::where('correu', $correu)->first(); // Busca el usuario por correo
        if ($user) {
            $token = bin2hex(random_bytes(16)); // Genera un token aleatorio
            $user->token_contrasenya = $token; // Asigna el token al campo remember_token
            $user->token_expiracio = now()->addHour(); // Asigna la fecha de expiración del token
            $user->save(); // Guarda el usuario con el nuevo token
            return $token; // Devuelve el token generado
        }
        return null; // Si no se encuentra el usuario, devuelve null
    }

    public function articles()
    {
        return $this->hasMany(Articles::class, 'correu', 'correu');
    }

    public static function getAllUsers()
    {
        return Usuari::all();
    }

    static function deleteUser($id)
    {
        $user = Usuari::where('id', $id)->first();
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }

    static function getUsuariByToken($token)
    {
        return Usuari::where('token_contrasenya', $token)->where('token_expiracio', '>', now())->first();
    }

    static function getUsuariByApiToken($token)
    {
        return Usuari::where('api_token', $token)->where('atoken_exp', '>', now())->first();
    }

    static function changePwd($correu, $token, $contrasenya)
    {
        $user = Usuari::where('correu', $correu)->where('token_contrasenya', $token)->first();
        if ($user) {
            $user->contrasenya = bcrypt($contrasenya); 
            $user->token_contrasenya = null;
            $user->token_expiracio = null; 
            $user->save();
            return true;
        }
        return false;
    }

    static function changeManualPwd($correu, $contrasenya)
    {
        $user = Usuari::where('correu', $correu)->first();
        if ($user) {
            $user->contrasenya = bcrypt($contrasenya); 
            $user->save();
            return true;
        }
        return false;
    }
}