<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usuarios.user', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('usuarios.show', compact('user'));
    }
} 