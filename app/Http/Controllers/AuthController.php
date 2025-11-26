<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLogin(): Response
    {
        return Inertia::render('Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle login request.
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Generate API key
        $user = $request->user();
        $user->api_key = Str::random(60);
        $user->save();

        return redirect()->route('dashboard');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
