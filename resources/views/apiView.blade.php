<!-- filepath: c:\laragon\www\uf4laravel\resources\views\apiView.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postres</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Postres</h1>
        <div id="postres-container" class="row">
            <!-- Los postres se cargarán aquí dinámicamente -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch('/api/postres');
                const postres = await response.json();

                const container = document.getElementById('postres-container');
                postres.forEach(postre => {
                    const card = document.createElement('div');
                    card.className = 'col-md-4 mb-4';
                    card.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${postre.nom}</h5>
                                <p class="card-text">${postre.descripcio}</p>
                                <p class="card-text"><strong>Precio:</strong> ${postre.preu} €</p>
                            </div>
                        </div>
                    `;
                    container.appendChild(card);
                });
            } catch (error) {
                console.error('Error al cargar los postres:', error);
            }
        });
    </script>
</body>
</html>