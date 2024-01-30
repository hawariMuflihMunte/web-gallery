<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $userData = $request->validate([
            'Username' => ['required', 'string', 'max:255'],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'Password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'Username' => $userData['Username'],
            'NamaLengkap' => $userData['NamaLengkap'],
            'Email' => $userData['Email'],
            'Password' => Hash::make($userData['Password']),
            'Alamat' => '-'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
