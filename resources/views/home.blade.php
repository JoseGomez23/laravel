<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <x-navbar />

    <br>
    <br>
    <br>
    <br>
    <br>

    <x-searchbar />


    <div class="articles">
    <div class="flexbox">
        @foreach ($articles as $article)
            <div class="articlesGrid">
                <h3 class="titolArticles">{{ $article->titol }}</h3>
                <p>{{ $article->cos }}</p>
            </div>
        @endforeach
    </div>
    </div>

    <!-- Enlaces de paginación -->
    <div class="pagination">
        {{ $articles->links() }}
    </div>
    
</body>
</html>