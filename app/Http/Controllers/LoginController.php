<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('login'); // pastikan ada file resources/views/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_username', $admin->username);
            return redirect('/admin')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_username']);
        return redirect('/login')->with('success', 'Anda berhasil logout!');
    }
}
