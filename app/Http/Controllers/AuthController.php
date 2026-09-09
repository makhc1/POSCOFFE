<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display login form.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($user->role === 'kasir') {
                return redirect()->route('kasir.pos');
            }

            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Process authentication request.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $msg = "Selamat datang kembali, {$user->name}!";

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', $msg);
            }
            if ($user->role === 'kasir') {
                return redirect()->intended(route('kasir.pos'))->with('success', $msg);
            }

            return redirect()->intended(route('home'))->with('success', $msg);
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    /**
     * Quick demo login for Admin or Kasir.
     */
    public function quickLogin(string $role): RedirectResponse
    {
        $targetEmail = match ($role) {
            'admin' => 'admin@kopigacoan.com',
            'kasir' => 'kasir@kopigacoan.com',
            default => 'admin@kopigacoan.com',
        };

        $user = User::where('email', $targetEmail)->first();

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            $dest = $user->role === 'admin' ? route('admin.dashboard') : route('kasir.pos');

            return redirect($dest)->with('success', 'Login cepat berhasil sebagai '.strtoupper($user->role)." ({$user->name})");
        }

        return redirect()->route('login')->with('error', 'User demo tidak ditemukan. Silakan jalankan db:seed.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar (Logout).');
    }

    /**
     * Display registration form.
     */
    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Process registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'customer', // Default role for public registration
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil. Selamat datang, ' . $user->name . '!');
    }
}
