protected $middlewareGroups = [
    'web' => [
        // ...existing code...
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        // ...existing code...
    ],
];