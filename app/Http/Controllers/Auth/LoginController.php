<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return view("app.auth.login");
        }

        return redirect()->route("gallery.index");
    }

    public function authenticate(Request $request): View|RedirectResponse
    {
        $credentials = $request->validate([
            "username" => "required|string|min:1",
            "password" => "required|string|min:8",
        ]);

        $user = User::where("Username", $credentials["username"])->first();

        if (is_null($user)) {
            return redirect()
                ->back()
                ->with("error-login", "Akun tidak ditemukan. Coba lagi");
        }

        $authPassword = password_verify(
            $credentials["password"],
            $user["Password"]
        );

        if ($authPassword) {
            Auth::login($user);

            return redirect()
                ->route("gallery.index")
                ->with(
                    "success-login",
                    "Selamat datang {$credentials["username"]} !"
                );
        }

        return redirect()
            ->back()
            ->with("error-login", "Akun tidak ditemukan. Coba lagi !");
    }
}
