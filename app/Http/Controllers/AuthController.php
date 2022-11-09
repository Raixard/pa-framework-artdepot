<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('login');
        }
    }

    public function actionRegister(Request $request)
    {
        if ($request->password == $request->confirm_password) {
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_image' => 'https://via.placeholder.com/300x300.png/434C5E?text=' . $request->username,
            ]);

            session()->flash('success', 'Berhasil membuat akun! Silakan masuk menggunakan informasi yang sudah Anda daftarkan.');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'Password dan konfirmasi password Anda berbeda!');
            return redirect()->route('register');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect('/');
        } else {
            session()->flash('error', 'Email atau password salah!');
            return redirect()->route('login');
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        session()->flash('success', 'Berhasil keluar');
        return redirect()->route('login');
    }
}
