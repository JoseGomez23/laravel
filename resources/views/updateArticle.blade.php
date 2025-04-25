<!DOCTYPE html>
<!--Jose Gomez-->
<html lang="en">
<head>

<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <x-navbar />
    
</header>
<br>
<br>
<br>
<br>
<br>

@if($article->correu !== Auth::user()->correu && Auth::user()->admin !== 1)
    <div class="divAlert">
        <p>No tens permís per modificar aquest article.</p>
    </div>
@else
    <div class="divForm">
        <h1>Modificar articles</h1>
        <hr>
    
        <form action="" method="post">
            @csrf
            <input class="intro" readonly type="text" name="titolmodificar" placeholder="Titol..." maxlength="40" value="{{ $article->titol ?? '' }}" required>
            <br>
            <br>
            <input class="intro" type="text" name="titolmodificat" placeholder="Nou Titol..." maxlength="2000" value="" required>
            <br>
            <textarea class="intro" id="cosmodificar" name="cosmodificar" placeholder="Introdueix el cos de l'article...">{{ $article->cos ?? '' }}</textarea>
            <hr>
            <div class="divButtons">
                <input class="buttons" type="submit" value="Modificar">
            </div>
        </form>
        <form action="/logedHome" method="get">
            <input class="buttons" type="submit" value="Tornar">
        </form>
    </div>
@endif

</body>
</html>