<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LogoutController extends Controller
{
    public function logout(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return view("auth.login");
        }

        Auth::logout();
        Session::invalidate();

        return redirect()->route("login");
    }
}
