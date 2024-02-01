<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
