@extends('layouts.global')

@section('title')
    Login | ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto grid md:grid-cols-4 auto-cols-fr">
        {{-- Spacer --}}
        <div class="hidden md:block"></div>

        {{-- Login Section --}}
        <div class="flex flex-col items-center rounded-lg px-6 py-6 space-y-3 bg-polar2 md:col-span-2">
            {{-- Title --}}
            <h1 class="font-bold text-2xl">Login</h1>

            {{-- Alert --}}
            <div class="bg-aurora0 px-3 py-6 w-full rounded-lg">
                <b>Yeah!</b> Sukses! Tapi boong yahahahahaha!!!
            </div>

            {{-- Login Form --}}
            <form action="" method="POST" class="w-full">
                @csrf
                {{-- Email Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="reg-email" class="font-medium">Email</label>
                    <input type="email" placeholder="Masukkan email Anda..." name="email" id="reg-email" required
                        class="p-3 rounded-lg text-polar0 outline-none">
                </div>

                {{-- Password Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="reg-password" class="font-medium">Password</label>
                    <input type="password" placeholder="Masukkan password Anda..." name="password" id="reg-password"
                        required class="p-3 rounded-lg text-polar0 outline-none">
                </div>

                {{-- Login Button --}}
                <button type="submit"
                    class="py-3 w-full rounded-lg bg-frost3 transition-colors hover:bg-frost2 focus:bg-frost2">
                    Log In
                </button>
            </form>

            {{-- Prompt to Register --}}
            <p class="w-full">
                Belum punya akun?
                <a href="{{ url('/register') }}"
                    class="text-frost1 underline rounded-lg transition-colors hover:bg-frost3/70 focus:bg-frost3/70" tabindex="0">
                    Registrasi sekarang.
                </a>
            </p>
        </div>

        {{-- Spacer --}}
        <div class="hidden md:block"></div>
    </div>
@endsection
