<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'min:1'],
            'namalengkap' => ['required', 'string', 'min:1', 'regex:/^[a-zA-Z]+(?:[\s,\.]{1,2}[a-zA-Z]+)*$/'],
            'email' => ['required', 'email', 'unique:user'],
            'password' => ['required', 'min:8'],
            'password-confirmation' => ['required', 'same:password'],
        ]);

        $user = User::create([
            'Username' => $credentials['username'],
            'NamaLengkap' => $credentials['namalengkap'],
            'Email' => $credentials['email'],
            'Password' => Hash::make($credentials['password']),
            'Alamat' => '-',
        ]);

        $request->session()->flash('success-register', 'Silahkan masuk !');

        return redirect('/login');
    }
}
