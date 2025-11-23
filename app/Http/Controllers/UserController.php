<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        // Vamos buscar o user só para o nome aparecer no título
        // Se der erro, usa findOrFail($id) que manda 404 se não existir
        $user = User::findOrFail($id);

        return view('pages.profile', ['user' => $user]);
    }
}
