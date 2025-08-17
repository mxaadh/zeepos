<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant\TenantUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TenantLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // simple form below
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Fetch user row by username
        $user = TenantUser::where('UserName', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
        }

        // Password check
        if ($request->password !== $user->PassWord) {
            return back()->withErrors(['password' => 'Invalid credentials.'])->withInput();
        }

        // Log in (uses session guard + your Eloquent provider)
        Auth::guard('web')->login($user, remember: $request->has('remember'));

        // Redirect to home
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
