<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('/index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah login input berupa email atau NIK
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        // Debugging untuk melihat apa yang diinputkan ke database
        dd([$loginField => $credentials['login'], 'password' => $credentials['password']]);

        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        $request->session()->flash('loginError', 'Login Failed!!!');
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
