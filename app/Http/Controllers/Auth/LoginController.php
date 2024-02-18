<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|min:1',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('Username', $credentials['username'])->first();

        if (is_null($user)) {
            return redirect()->back()->with('error-login', 'Akun tidak ditemukan. Coba lagi');
        }

        $authPassword = password_verify($credentials['password'], $user['Password']);

        if ($authPassword) {
            Auth::login($user);

            return redirect()->route('gallery.index')->with('success-login', "Selamat datang {$credentials['username']} !");
        }

        return redirect()->back()->with('error-login', 'Akun tidak ditemukan. Coba lagi')->withInput();
    }
}
