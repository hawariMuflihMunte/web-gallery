<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return view("pages.profile-index", compact("user"));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        dd($request->all(), $user);

        $message = [
            "username.min" => "Masukkan minimal 1 karakter !",
            "namalengkap.min" => "Masukkan minimal 1 karakter !",
            "email.min" => "Masukkan minimal 1 karakter !",
            "alamat.min" => "Masukkan minimal 1 karakter !",
            "unique" => "Tidak dapat memproses data !",
        ];

        $validation = [
            'alamat' => 'required|min:1',
        ];

        if ($user->Username != $request->username) {
            $validation['username'] = 'required|min:1|unique:user,Username';
        }

        if ($user->NamaLengkap != $request->namalengkap) {
            $validation['namalengkap'] = 'required|min:1|unique:user,NamaLengkap';
        }

        if ($user->Email != $request->email) {
            $validation['email'] = 'required|min:1|unique:user,Email';
        }

        $profile = $request->validate($validation, $message);

        $update = [
            'Username' => $profile['username'] ?? $user->Username,
            'NamaLengkap' => $profile['namalengkap'] ?? $user->NamaLengkap,
            'Email' => $profile['email'] ?? $user->Email,
            'Alamat' => $profile['alamat'],
        ];

        $user->update($update);

        return redirect()
            ->route("profile.index")
            ->with([
                "profile-update-success" => "{{ __('app.profile-update-success') }}",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // User::destroy($id);
        $user->delete();

        return redirect()
            ->route("login")
            ->with([
                "success-user-delete" => "Berhasil menghapus akun !",
            ]);
    }
}
