<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('Administrador')) {
            return redirect()->route('dashboard');
        } elseif ($user && $user->hasRole('User')) {
            return redirect()->route('dashboardUsuario');
        } else {
            abort(403, 'No tienes acceso a ningún dashboard.');
        }
    }
} 