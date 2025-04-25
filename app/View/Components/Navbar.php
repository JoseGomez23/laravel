<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $usuari;
    public $admin;

    public function __construct()
    {
        $this->usuari = session('usuari'); // Verifica que 'usuari' esté configurado en la sesión
        $this->admin = session('admin');   // Verifica que 'admin' esté configurado en la sesión
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
