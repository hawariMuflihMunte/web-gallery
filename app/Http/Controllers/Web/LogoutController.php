<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        if (!auth()->check()) {
            return view("pages.auth-login");
        }

        auth()->logout();
        session()->invalidate();

        return redirect()->route("login");
    }
}
