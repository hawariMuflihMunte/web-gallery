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
        return view("pages.auth-register");
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required|string|min:1",
            "namalengkap" =>
                'required|string|min:1|regex:/^[a-zA-Z]+(?:[\s,\.]{1,2}[a-zA-Z]+)*$/',
            "email" => "required|email:unique",
            "password" => "required|min:8",
            "password-confirmation" => "required|same:password",
        ]);

        $checkUsernameFromDB = User::where(
            "Username",
            "=",
            $credentials["username"]
        )->first();

        if (!empty($checkUsernameFromDB)) {
            return redirect()
                ->back()
                ->with([
                    "error-register" =>
                        "Username sudah terpakai. Gunakan username lain !",
                ])
                ->withInput();
        }

        $checkEmailFromDB = User::where(
            "Email",
            "=",
            $credentials["email"]
        )->first();
        $checkNamaLengkapFromDB = User::where(
            "NamaLengkap",
            "=",
            $credentials["namalengkap"]
        )->first();

        if (!empty($checkEmailFromDB) || !empty($checkNamaLengkapFromDB)) {
            return redirect()
                ->back()
                ->with(
                    "error-register",
                    "Pendaftaran gagal. Silahkan coba lagi !"
                );
        }

        User::create([
            "Username" => $credentials["username"],
            "NamaLengkap" => $credentials["namalengkap"],
            "Email" => $credentials["email"],
            "Password" => Hash::make($credentials["password"]),
            "Alamat" => "-",
        ]);

        return redirect("/login")->with("success-register", "Silahkan masuk !");
    }
}
