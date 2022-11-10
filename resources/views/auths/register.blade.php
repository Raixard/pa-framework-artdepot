@extends('layouts.global')

@section('title')
    Registrasi | ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto grid md:grid-cols-4 auto-cols-fr">
        {{-- Spacer --}}
        <div class="hidden md:block"></div>

        {{-- Registration Section --}}
        <div class="flex flex-col items-center rounded-lg px-6 py-6 space-y-3 bg-polar2 md:col-span-2">
            {{-- Title --}}
            <h1 class="font-bold text-2xl">Registrasi</h1>

            {{-- Error Alert --}}
            @if (session('error'))
                <div class="bg-aurora0 px-3 py-6 w-full rounded-lg">
                    <b>Ups!</b> {{ session('error') }}
                </div>
            @endif

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="bg-aurora0 px-3 py-6 w-full rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('actionRegister') }}" method="POST" class="w-full">
                @csrf
                {{-- Username Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="reg-username" class="font-medium">Username</label>
                    <input type="text" placeholder="Masukkan username Anda..." name="username" id="reg-username" required
                        pattern="[A-Za-z0-9_]{4,20}" class="p-3 rounded-lg text-polar0 outline-none">
                    <span class="font-light italic text-sm">Username terdiri dari 4-20 karakter huruf (a-z), angka (0-9), dan garis bawah (_).</span>
                </div>

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
                        pattern=".{8,64}" required class="p-3 rounded-lg text-polar0 outline-none">
                        <span class="font-light italic text-sm">Password terdiri dari 8 sampai 64 karakter</span>
                </div>

                {{-- Confirm Password Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="reg-confirm-password" class="font-medium">Konfirmasi Password</label>
                    <input type="password" placeholder="Masukkan kembali password Anda..." name="confirm_password"
                        pattern=".{8,64}" id="reg-confirm-password" required class="p-3 rounded-lg text-polar0 outline-none">
                </div>

                {{-- Register Button --}}
                <button type="submit"
                    class="py-3 w-full rounded-lg bg-frost3 transition-colors hover:bg-frost2 focus:bg-frost2">
                    Registrasi
                </button>
            </form>

            {{-- Prompt to Login --}}
            <p class="w-full">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="text-frost1 underline rounded-lg transition-colors hover:bg-frost3/70 focus:bg-frost3/70"
                    tabindex="0">
                    Login sekarang.
                </a>
            </p>
        </div>

        {{-- Spacer --}}
        <div class="hidden md:block"></div>
    </div>
@endsection
