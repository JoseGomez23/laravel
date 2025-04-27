<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\UsersController;
use App\Models\Usuari;
use App\Http\Controllers\PwdController;
use App\Http\Controllers\ApiController;
use App\Models\Api;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect('../logedHome');
        }
        return view('home');
    });
    Route::get('/', [ArticleController::class, 'index']);

    

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('logini');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/logedHome', 'logedHome')->middleware('auth')->name('logedHome');
    
    Route::get('/logedHome', [ArticleController::class, 'logedHome']);

    //Route::view('/insert', 'insert')->middleware('auth')->name('insert');
    Route::get('/insert', function () {
        return view('insert');
    })->middleware('auth')->name('insert');
    
    Route::post('/insert', [ArticleController::class, 'insertArticle']);

    Route::view('/deleteArticle/{id}', 'deleteArticle')->middleware('auth')->name('deleteArticle');
    Route::get('/deleteArticle/{id}', [ArticleController::class, 'getArticleDelete']);
    Route::post('/deleteArticle/{id}', [ArticleController::class, 'deleteArticleController']);
    
    Route::view('/updateArticle/{id}', 'updateArticle')->middleware('auth')->name('updateArticle');
    Route::get('/updateArticle/{id}', [ArticleController::class, 'getArticle']);
    Route::post('/updateArticle/{id}', [ArticleController::class, 'modArticle']);

    Route::view('/bdUsers', 'bdUsers')->middleware('auth')->name('bdUsers');
    Route::get('/bdUsers', [UsersController::class, 'bdUsers']);

    Route::get('/deleteUser/{id}', function ($id) {
        Usuari::deleteUser($id);
        return redirect('/bdUsers')->with('success', 'Usuari eliminat correctament');
    })->middleware('auth');

    Route::get('/logout', function () {
        AuthController::logout(request());
        return redirect('/')->with('success', 'Has tancat sessió correctament');
    })->name('logout');

    Route::view('/userProfile', 'userProfile')->middleware('auth')->name('userProfile');
    Route::get('/userProfile', function () {
        return view('userProfile');
    })->middleware('auth');
    Route::post('/userProfile', [UsersController::class, 'updateProfile'])->middleware('auth');

    Route::get('/auth/redirect/google', function () {
        return Socialite::driver('google')
            ->redirect();
    });

    Route::get('/auth/callback/google', [AuthController::class, 'authGoogle']);
        
    Route::get('/recuperar', function () {
        return view('enviarCorreu');
    })->name('recuperar.form');
    
    Route::post('/recuperar', [PwdController::class, 'enviarCorreu'])->name('recuperar.email');

    Route::view('/pwdReset/{token}', 'recuperar')->name('recuperar');
    Route::post('/pwdReset/{token}', [PwdController::class, 'resetPwd']);

    Route::view('/api',  'apiView')->name('api');
    Route::get('/api', [ApiController::class, 'getPostres']);

    Route::view('/api/{titol}',  'apiView')->name('apiF');
    Route::get('/api/{titol}', [ApiController::class, 'fiteredPostres']);

    Route::view('/resetPwd', 'resetPwd')->name('resetPwd')->middleware('auth');
    Route::post('/resetPwd', [PwdController::class, 'resetManualPwd']);

});

//Route::view('/', 'home')->name('home');