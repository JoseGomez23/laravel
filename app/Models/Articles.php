<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['titol', 'cos', 'correu'];


    public static function getArticles($perPage, $name, $ordre) {

        if ($name) {
            return self::where('titol', 'like', '%' . $name . '%')->paginate($perPage);
        }

        if ($ordre == 'ASC') {
            return self::orderBy('titol', $ordre)->paginate($perPage);
        }

        if ($ordre == 'DESC') {
            return self::orderBy('titol', $ordre)->paginate($perPage);
        }
        if ($ordre == 'ASCD') {
            return self::orderBy('id', 'asc')->paginate($perPage);
        }
        if ($ordre == 'DESCD') {
            return self::orderBy('id', 'desc')->paginate($perPage);
        }
        return self::query()->paginate($perPage); // ✅ Asegura que devuelve un Paginator
    }
        

    public static function userArticles($correu, $perPage, $name, $ordre)
    {
        if ($name) {
            return self::where('correu', $correu)->where('titol', 'like', '%' . $name . '%')->paginate($perPage);
        }

        if ($ordre == 'ASC') {
            return self::where('correu', $correu)->orderBy('titol', $ordre)->paginate($perPage);
        }
        if ($ordre == 'DESC') {
            return self::where('correu', $correu)->orderBy('titol', $ordre)->paginate($perPage);
        }
        if ($ordre == 'ASCD') {
            return self::where('correu', $correu)->orderBy('id', 'asc')->paginate($perPage);
        }
        if ($ordre == 'DESCD') {
            return self::where('correu', $correu)->orderBy('id', 'desc')->paginate($perPage);
        }

        return self::where('correu', $correu)->paginate($perPage);
    }

    public static function adminGetArticles($perPage, $name, $ordre)
    {
        if ($name) {
            return self::where('titol', 'like', '%' . $name . '%')->paginate($perPage);
        }

        if ($ordre == 'ASC') {
            return self::orderBy('titol', $ordre)->paginate($perPage);
        }
        if ($ordre == 'DESC') {
            return self::orderBy('titol', $ordre)->paginate($perPage);
        }
        if ($ordre == 'ASCD') {
            return self::orderBy('id', 'asc')->paginate($perPage);
        }
        if ($ordre == 'DESCD') {
            return self::orderBy('id', 'desc')->paginate($perPage);
        }

        return self::paginate($perPage);
    }

    public static function createArticle($titol, $cos, $correu)
    {
        $article = new Articles();
        $article->titol = $titol;
        $article->cos = $cos;
        $article->correu = $correu;
        $article->save();

    }

    public static function checkArticle($name)
    {
        return self::where('titol', $name)->exists();
    }

    public static function deleteArticle($name, $correu, $admin)
    {
    
        $article = "";
        if($admin == 1){
            $article = self::where('titol', $name)->first();
        } else  {
            $article = self::where('titol', $name)->where('correu', $correu)->first();
        }

        
        if ($article || $admin) {
            $article->delete();
            return true;
        }
        return false;
    }
    
    public static function modifyArticle($name, $correu, $newName, $newContent, $admin)
    {

        $article = "";
        if($admin == 1){
            $article = self::where('titol', $name)->first();
        } else  {
            $article = self::where('titol', $name)->where('correu', $correu)->first();
        }

        $exists = self::getArticle($newName);
        
        if (!$exists) {
            
            if ($article) {
                $article->titol = $newName;
                $article->cos = $newContent;
                $article->save();
                return true;
            }
        }
        return false;
    }

    public static function getArticle($name)
    {
        
        return self::where('titol', $name)->exists();
    }
}

