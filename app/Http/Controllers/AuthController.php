<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // MODIFICADO: Ahora este método controla si el usuario tiene permiso o no
    public function mostrarLogin()
    {
        // Si el usuario YA está logueado en la sesión, lo mandamos directo a la Tienda
        if (Auth::check()) {
            return redirect()->route('productos.index');
        }

        // Si NO está logueado, le muestra el login normalmente
        return view('login');
    }

    public function autenticar(Request $request)
    {
        // 1. Validaciones estrictas únicamente de los campos del formulario de login simplificado
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'], 
        ], [
            'email.required'    => 'El Correo Electrónico es Obligatorio.',
            'email.email'       => 'Por Favor, Introduce Una Dirección de Correo Válida.',
            'password.required' => 'La Contraseña Es Obligatoria.',
        ]);

        // 2. Tomamos únicamente email y password para validar con la DB
        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->route('productos.index')->with('success', '¡Bienvenido al Sistema!');
        }

        // Si falla la combinación de correo y clave en la DB
        return back()->withErrors([
            'email' => 'El Acceso Ha Sido Denegado. Verifica que el Correo o Contraseña Sean Correctos.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}