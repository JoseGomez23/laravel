<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió d'Usuaris</title>
</head>
<body>
    

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nomusuari }}</td>
                        <td>{{ $user->correu }}</td>
                        <td>
                            @if ($user->admin == 0)
                                <a href="{{ url('deleteUser/' . $user->id) }}">Eliminar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Estas segur que vols eliminar l'usuari?</p>
            <div class="modal-actions">
                <button id="confirmDelete" class="confirm">Sí</button>
                <button id="cancelDelete" class="cancel">No</button>
            </div>
        </div>
    </div>

    <form action="/logedHome">
        <input type="submit" value="Tornar">
    </form>


    <script src="../controlador/modalEliminar.js"></script>
</body>
</html>
