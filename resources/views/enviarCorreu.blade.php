<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contrasenya</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('estils/estilsFormularis.css') }}">
</head>
<body>
    <div class="divForm">
        <form method="POST" action="{{ route('recuperar.email') }}">
            @csrf
            
            <h1>Introdueix el teu correu electrònic</h1>

            <input class="intro" type="email" name="email" placeholder="ex: usuari@sapalomera.cat" required>

            <div class="divButtons">
                <input class="buttons" type="submit" value="Recuperar contrasenya">
            </div>
        </form>

        <form action="{{ url('/') }}">
            <input class="buttons" type="submit" value="Tornar">
        </form>
    </div>

    <div class="divAlert">
        @if (session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color: red">{{ $error }}</p>
            @endforeach
        @endif
    </div>
</body>
</html>
