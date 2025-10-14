<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Tampilkan form lupa password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Proses “kirim reset” → redirect ke form reset password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:admins,username',
        ]);

        $username = $request->input('username');

        return redirect()->route('reset.form', ['username' => $username])
                         ->with('status', 'Silakan reset password untuk username: '.$username);
    }

    // Tampilkan form reset password
    public function showResetForm($username)
    {
        return view('auth.reset-password', ['username' => $username]);
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:admins,username',
            'password' => 'required|confirmed|min:6',
        ]);

        DB::table('admins')
            ->where('username', $request->username)
            ->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login.form')->with('status', 'Password berhasil diubah!');
    }
}
