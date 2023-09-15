<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return inertia()->render("auth/LoginPage");
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        $login = auth()->attempt($request->all());
        if(!$login){
            return throw ValidationException::withMessages([
                'username' => 'Username atau password salah.'
            ]);
        }
        return redirect()->route('dashboard.index');
    }
}
