<p>Hola {{ $usuari->name }},</p>

<p>Has sol·licitat restablir la contrasenya. Fes clic a l'enllaç següent:</p>

<p>
    <a href="{{ url('/password/reset/' . $usuari->reset_token) }}">
        Restablir contrasenya
    </a>
</p>

<p>L'enllaç caducarà en 30 minuts.</p>
