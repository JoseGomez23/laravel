

?>

<!DOCTYPE html>
<!--Jose Gomez-->
<html lang="en">
<head>
    <title>Document</title>
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

@if(Auth::user()->admin !== 1 && $article->correu !== Auth::user()->correu)
    <div class="divAlert">
        <p>No tens permís per eliminar aquest article.</p>
    </div>
@else

    <div class="divForm">
        <h1>Eliminar articles</h1>
        
        <form action="" method="post">
            @csrf
            <tr>
                <br>
                <input class="intro" type="text" name="titoleliminar" placeholder="Titol" value="{{ $article->titol }}" readonly required>
                <div class="divButtons">
                <input class="buttons" type="submit" name="eliminarseguretat" value="Eliminar article">
            </tr>
        </form>
        

        <form action="/logedHome" method="get">
            <input class="buttons" type="submit" value="Tornar">
        </form>
        </div>
        <div class="divAlert">
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (request()->isMethod('post') && old('titoleliminar'))
            <form method="post" action="{{ route('articles.confirmDelete') }}">
                @csrf
                <p>Estàs segur que vols eliminar l'article: {{ old('titoleliminar') }}?</p>
                <input type="hidden" name="titoleliminar" value="{{ old('titoleliminar') }}">
                <input class="buttons" type="submit" name="eliminarsegur" value="Eliminar">
            </form>
        @endif
        </div>
        </div>  
    @endif
</body>
</html>