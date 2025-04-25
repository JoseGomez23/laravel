<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuari;

class ArticleController extends Controller
{
    public function index(Request $request) {

        $articlesPerPage = $request->input('articlesperpag');
        if ($articlesPerPage) {
            cookie()->queue('articles_per_page', $articlesPerPage, 60);
        } else {
            $articlesPerPage = $request->cookie('articles_per_page', 5);
        }

        $ordre = request('ordre');
        $name = request('titolc');
        $articles = Articles::getArticles($articlesPerPage, $name, $ordre);
        return view('home', compact('articles'));
    }

    public function logedHome(Request $request)
    {
        $user = Auth::user();

        $articlesPerPage = request('articlesperpag');
        if ($articlesPerPage) {
            cookie()->queue('articles_per_page', $articlesPerPage, 60);
        } else {
            $articlesPerPage = $request->cookie('articles_per_page', 5);
        }
        $ordre = request('ordre');

        $name = request('titolc');

        $articles = "";
        
        if($user->admin = 1) {
            $articles = Articles::adminGetArticles($articlesPerPage, $name, $ordre);
        } else {
            $articles = Articles::userArticles($user->correu, $articlesPerPage, $name, $ordre);
        }

        return view('logedHome', compact('articles'));
    }

    public function insertArticle(){

        $user = Auth::user();

        $articleName = request('titolinserir');
        $articleContent = request('cosinserir');

        if (Articles::checkArticle($articleName)) {
            return redirect('/insert')->with('error', 'El títol ja existeix');
        }
        
        Articles::createArticle(
            $articleName,
            $articleContent,
            $user->correu
        );


        return redirect('/insert')->with('success', 'Article creat correctament');

    }

    public function deleteArticleController()
    {
        $name = request('titoleliminar');
        $user = Auth::user();

        $article = Articles::checkArticle($name);

        if(!$article) {
            return redirect('/deleteArticle')->with('error', 'Article no trobat');
        }
        $admin = $user->admin;
        if (Articles::deleteArticle($name, $user->correu, $admin)) {
            return redirect('/logedHome')->with('success', 'Article esborrat correctament');
        } else {
            return redirect('/logedHome')->with('error', 'No s\'ha pogut esborrar l\'article');
        }
    }

    public function modArticle(){

        $name = request('titolmodificar');
        $newName = request('titolmodificat');
        $newContent = request('cosmodificar');
        $user = Auth::user();

        $article = Articles::checkArticle($name);

        if(!$article) {
            return redirect('/updateArticle')->with('error', 'Article no trobat');
        }

        $admin = $user->admin;
        if (Articles::modifyArticle($name, $user->correu, $newName, $newContent, $admin) && Articles::getArticle($newName) == false) {
            return redirect('/logedHome')->with('success', 'Article modificat correctament');
        } else {
            return redirect('/updateArticle/1')->with('error', 'No s\'ha pogut modificar l\'article');
        }

    }

    public function getArticle($id)
    {
        $article = Articles::find($id);

        if (!$article) {
            return redirect('/logedHome')->with('error', 'Article no trobat');
        }

        return view('updateArticle', compact('article'));
    }

    public function getArticleDelete($id)
    {
        $article = Articles::find($id);

        if (!$article) {
            return redirect('/logedHome')->with('error', 'Article no trobat');
        }

        return view('deleteArticle', compact('article'));
    }

}
