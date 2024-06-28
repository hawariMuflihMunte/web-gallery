<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        $user = User::where("Username", $credentials["username"])->first();

        if (is_null($user)) {
            return redirect()
                ->back()
                ->with([
                    "login-error" => __("app.login_error"),
                ]);
        }

        $authPassword = password_verify(
            $credentials["password"],
            $user["Password"]
        );

        if ($authPassword) {
            auth()->login($user);

            return redirect()
                ->route("album.index")
                ->with([
                    "login-success" => __("app.login_success_with_message", [
                        "name",
                        auth()->user()->Username,
                    ]),
                ]);
        }

        return redirect()
            ->back()
            ->with([
                "login-error" => "{{ __('app.login_error') }}",
            ]);
    }
}
