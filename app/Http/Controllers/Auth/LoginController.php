<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'min:1'],
            'password' => ['required', 'min:8'],
        ]);

        $auth = User::where('Username', $credentials['username'])->first();
        $authPassword = password_verify($credentials['password'], $auth['Password']);
        $checkExisted = User::where('Username', 'hawariMuflih')->get();

        dd($auth, $authPassword, $checkExisted);
    }
}
