<!DOCTYPE html>
<!--Jose Gómez-->
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="divForm">
<form method="post">
        @csrf
        <div>
            <input class="intro" type="password" placeholder="Contrasenya actual" name="contrasenya">
            <br>
            
            <input class="intro" type="password" placeholder="Contrasenya nova" name="contrasenyanova">
            <br>

            <input class="intro" type="password" placeholder="Confirmar contrasenya" name="contrasenyanovaconf">
            <br>

            <div class="divButtons">
            <input class="buttons" type="submit" value="Canviar contrasenya">
            
        </div>

        <p></p>
        </form>
        <form action="/logedHome">

            <input class="buttons" type="submit" value="Tornar">
        </form>
</div>
    <div class="divAlert">
       
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</body>
</html>