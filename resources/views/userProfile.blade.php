<?php

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <navbar-x />

</header>
    <div class="divForm">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <p>Imatge de d'usuari</p>
            <input type="file" name="imatge" accept="image/*">
            <p>Nom d'usuari</p>
            <input class="intro" type="text" name="nouusuari" maxlength="40" value="{{ Auth::user()->nomusuari }}" required>
            
            @if (Auth::user()->google_id == null)
                <p>Correu electronic</p>
                <input class="intro" type="text" name="noucorreu" value="{{ Auth::user()->correu }}">
                <br><br>
                <p>Si vols canviar la teva contrasenya clica <a class="links" href="{{ url('resetPwd') }}">AQUI.</a></p>
            @endif
            
            <div class="divButtons">
                <input class="buttons" type="submit" value="Guardar canvis">
            </div>
        </form>
        <form action="/logedHome">
            <input class="buttons" type="submit" value="Tornar">
        </form>
    </div>

</body>
</html>