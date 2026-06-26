<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['email' => "Trop de tentatives. Réessayez dans $seconds secondes."]);
        }

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->regenerate();
            RateLimiter::clear($key);
            session(['admin_id' => $admin->id]);
            return redirect()->route('dashboard.index');
        }

        RateLimiter::hit($key, 60);
        return back()->withErrors(['email' => 'Identifiants invalides.']);
    }

    public function logout(Request $request)
    {
        
        session()->forget('admin_id');
        // Regenerate session to prevent session fixation
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
