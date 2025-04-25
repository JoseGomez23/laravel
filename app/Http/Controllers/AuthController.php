<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuari;
use App\Models\Api;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usuaris,correu', 
            'nomusuari' => 'required', 
            'contrasenya' => 'required|min:6',
            'contrasenya_confirm' => 'required|same:contrasenya', 
        ]);

        $pwd = $request->contrasenya;

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/', $pwd)) {
            return redirect()->back()->with('error', 'La nova contrasenya no compleix els requisits de seguretat.');
        }

        Usuari::createUsuari(
            $request->email,
            $request->contrasenya,
            $request->nomusuari
        );

        return redirect('/login')->with('success', 'Usuari registrat.');
    }

    public function authGoogle()
    {
        $googleUser = Socialite::driver('google')->user();
        
        
        $usuari = Usuari::getUsuari($googleUser->getEmail());
    
        
        if (!$usuari) {
            $usuari = Usuari::createGoogleUsuari(
                $googleUser->getEmail(),
                $googleUser->getName(),
                $googleUser->getId()
            );

            $usuari = Usuari::getUsuari($googleUser->getEmail());
        }


        $token = Api::generateApiToken($usuari->correu);
        Auth::login($usuari);
    
        return redirect()->intended('/logedHome')
            ->cookie('api_token', $token, 60); 
    }

    protected $usuari;

    function __construct(Usuari $usuari) {
        $this->usuari = $usuari;
    }

    public static function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        Cookie::queue(Cookie::forget('api_token'));

        return redirect('/login');
    }


    public function login(Request $request) {

        
        $request->validate([
            'email' => 'required|email',
            'contrasenya' => 'required',
        ]);
    
        
        $user = Usuari::where('correu', $request->email)->first();
    

        if (!$user) {
            return back()->withErrors([
                'email' => 'L\'usuari no existeix',
            ])->withInput();
        }
    

        if (!Hash::check($request->contrasenya, $user->contrasenya)) {
            return back()->withErrors([
                'contrasenya' => 'La contrasenya es incorrecte',
            ])->withInput();
        }

        $token = Api::generateApiToken($user->correu);
        Auth::login($user);
    
        $request->session()->regenerate();
    
        return redirect()->intended('/logedHome')
            ->cookie('api_token', $token, 60);
    }
    
    
    


}

?>


