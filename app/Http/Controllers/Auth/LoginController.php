<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'min:1'],
            'password' => ['required', 'min:8'],
        ]);

        $auth = User::where('Username', $credentials['username'])->first();
        $authPassword = password_verify($credentials['password'], $auth['Password']);

        $checkUsername = User::find($credentials['username']);
        $checkPassword = User::find($credentials['password']);
        $checkExisted = User::where('Username', 'hawariMuflih')->get();

        dd($auth, $authPassword, $checkUsername, $checkPassword, $checkExisted);
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
