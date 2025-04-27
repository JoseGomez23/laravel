
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
</head>
<body>

<div class="divForm">
    <form method="post">
        @csrf
        <input class="intro" type="password" name="novacontrasenya" placeholder="Nova contrasenya">
        <input class="intro" type="password" name="novaconf" placeholder="Confirmar contrasenya">
        <div class="divButtons">
        <input class="buttons" type="submit" value="Canviar contrasenya">

    </form>
    <form action="../index.php">
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
</div>
</body>
</html>