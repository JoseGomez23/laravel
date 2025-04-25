<!-- filepath: c:\laragon\www\uf4laravel\resources\views\login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <script src="https://www.google.com/recaptcha/api.js?render='tu_clave_reCAPTCHA'"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('tu_clave_reCAPTCHA', { action: 'submit' }).then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
            });
        });
    </script>
</head>
<body>
    <div class="divForm">
        <h1>Iniciar Sessió</h1>
        <hr><br>

        <!-- Mostrar errores -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('logini') }}">
            @csrf
            <input class="intro" type="email" name="email" placeholder="EMAIL" value="{{ old('email') }}">
            <br>
            <input class="intro" type="password" name="contrasenya" placeholder="Contrasenya">

            <br>
            <input type="checkbox" name="remember"> Recorda'm
            <hr>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
            <br>
            <p><a class="links" href="{{ route('register') }}">Registrar-se</a></p>
            <p><a class="links" href="">Restablir Contrasenya</a></p>
            <hr>
            <input class="buttons" type="submit" value="Iniciar sessió">
        </form>
        
        <a href="/auth/redirect/google" style="text-decoration: none;">
            <button style="padding: 10px 20px; background: #4285F4; color: white; border: none; border-radius: 5px;">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" style="width:20px; vertical-align: middle; margin-right: 10px;">
                Iniciar sesión con Google
            </button>
        </a>

        <br>
        <form action="/">
            <input class="buttons" type="submit" value="Tornar">
        </form>
    </div>
</body>
</html>