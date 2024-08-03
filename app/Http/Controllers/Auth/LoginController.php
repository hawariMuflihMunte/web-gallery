<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!auth()->check()) {
            return view("pages.auth-login");
        }

        return redirect()->route("album.index");
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "username" => "required|string|min:1",
            "password" => "required|string|min:8",
        ]);

        if (auth()->attempt($credentials)) {
            return redirect()
                ->route("album.index")
                ->with([
                    "success" => __("app.login_success"),
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    "error" => __("app.login_error"),
                ]);
        }
    }
}
