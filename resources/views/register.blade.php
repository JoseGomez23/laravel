<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="divForm">
    <form method="post" action="{{ route('register') }}">
        @csrf
        <h1>Formulari de registre</h1>
        <hr>
        <div>
            <br>
            <input class="intro" type="text" name="nomusuari" placeholder="Nom usuari" maxlength="40" value="{{ old('nomusuari') }}">
            @error('nomusuari')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>

            <input class="intro" type="password" placeholder="Contrasenya" name="contrasenya">
            @error('contrasenya')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>

            <input class="intro" type="password" placeholder="Confirmar Contrasenya" name="contrasenya_confirm">
            @error('contrasenya_confirm')
                <span class="error">{{ $message }}</span>
            @enderror
            <br>

            <input class="intro" type="email" placeholder="Correu Electronic" name="email" value="{{ old('email') }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <hr>
        <p><a class="links" href="../login">Inicia sessió</a></p>
        <hr>
        <div class="divButtons">
            <input class="buttons" type="submit" value="Registrar-se">
        </div>
    </form>
    <form action="/">
        <input class="buttons" type="submit" value="Tornar">
    </form>
    </div>

    @if (session('error'))
        <div class="error-summary">
            <h3>Error:</h3>
            <ul>
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif
</body>
</html>