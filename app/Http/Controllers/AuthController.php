<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Viewing login page
    public function loginView()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auths.login');
        }
    }

    // Viewing registration page
    public function registerView()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auths.register');
        }
    }

    // Registration process
    public function actionRegister(Request $request)
    {
        if ($request->password == $request->confirm_password) {
            $request->validate([
                'username' => ['required', 'unique:users', 'min:4', 'max:20', 'distinct:ignore_case'],
                'email' => ['required', 'unique:users'],
                'password' => ['required', 'unique:users', 'min:8', 'max:64'],
            ]);

            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'User',
                'profile_image' => 'user-default.jpg',
            ]);

            session()->flash('success', 'Berhasil membuat akun! Silakan masuk menggunakan informasi yang sudah Anda daftarkan.');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'Password dan konfirmasi password Anda berbeda!');
            return redirect()->route('register');
        }
    }

    // Login process
    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $auth = Auth::user()->role;
            if ($auth == 'User') {
                return redirect('/')->with('role','user');
            }else{
                return redirect('home-admin')->with('role','admin');
            }
            
        } else {
            session()->flash('error', 'Email atau password salah!');
            return redirect()->route('login');
        }
    }

    // Logout process
    public function actionLogout()
    {
        Auth::logout();
        session()->flash('success', 'Berhasil keluar');
        return redirect()->route('login');
    }
}