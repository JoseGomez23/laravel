
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

<div class="divForm">
    <h1>Inserir Articles</h1>
    
    <form action="" method="post">
        @csrf
        <input class="intro" type="text" name="titolinserir" placeholder="Titol..." maxlength="40" value="<?php echo htmlspecialchars($_POST["titolinserir"] ?? $_GET['titol'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <div class="divButtons">
            <textarea class="intro" id="cosinserir" name="cosinserir" placeholder="Introdueix el cos de l'article..." maxlength="2000" required><?php echo $_POST["cosinserir"] ?? $_GET['cos'] ?? '' ?></textarea>
            <input class="buttons" type="submit" value="Inserir" @if (!Auth::check()) disabled @endif>
        </div>
    </form>
    <form action="/logedHome" method="get">
        <input class="buttons" type="submit" value="Tornar">
    </form>
    @if (!Auth::check())
        <p class="alert">Necessites iniciar sessió per poder introduir articles.</p>
    @endif
</div>

<br>

<div class="divAlert">
    @if (session('success'))
        <p class="alert success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="alert error">{{ session('error') }}</p>
    @endif
</div>

</body>
</html>
