@extends('layouts.global')

@section('title')
    Edit Profil | ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto grid md:grid-cols-4 auto-cols-fr">
        {{-- Spacer --}}
        <div class="hidden md:block"></div>

        {{-- Login Section --}}
        <div class="flex flex-col items-center rounded-lg px-6 py-6 space-y-3 bg-polar2 md:col-span-2">
            {{-- Title --}}
            <h1 class="font-bold text-2xl">Edit Profil</h1>

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

            {{-- Current Creation Image --}}
            <div class="flex justify-center">
                <img src="{{ asset('img/users/' . $user->profile_image) }}" class="rounded-full" alt="{{ $user->username }}">
            </div>

            {{-- Creation Form --}}
            <form action="{{ route('userUpdate', $user->username) }}" method="POST" enctype="multipart/form-data"
                class="w-full">
                @csrf
                @method('put')
                {{-- Image Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="create-image" class="font-medium">Foto Profil</label>
                    <input type="file" name="image" id="create-image" accept=".jpg, .jpeg, .png">
                    <span class="font-light italic text-sm">
                        Foto profil berekstensi .png, .jpg, atau .jpeg dengan rasio 1:1
                    </span>
                </div>

                {{-- Description Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="user-biography" class="font-medium">Tentang Saya</label>
                    <textarea type="text" placeholder="Masukkan biografi Anda..." name="biography" id="user-biography" rows="6"
                        required class="p-3 rounded-lg text-polar0 outline-none resize-none">{{ $user->biography }}</textarea>
                    <span class="font-light italic text-sm">
                        Biografi memiliki batas 255 karakter
                    </span>
                </div>

                {{-- Update Button --}}
                <button type="submit"
                    class="py-3 w-full rounded-lg bg-frost3 transition-colors hover:bg-frost2 focus:bg-frost2">
                    Simpan
                </button>
            </form>
            <span class="border w-full"></span>
            <h2 class="text-center">Ganti Password</h2>
            <form action="{{ route('changePassword')}}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="reg-password" class="font-medium">Password</label>
                    <input type="password" placeholder="Masukkan password baru Anda..." name="password" id="reg-password"
                        pattern=".{8,64}" required class="p-3 rounded-lg text-polar0 outline-none">
                        <span class="font-light italic text-sm">Password terdiri dari 8 sampai 64 karakter</span>
                </div>

                {{-- Confirm Password Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="reg-confirm-password" class="font-medium">Konfirmasi Password</label>
                    <input type="password" placeholder="Masukkan kembali password baru Anda..." name="confirm_password"
                        pattern=".{8,64}" id="reg-confirm-password" required class="p-3 rounded-lg text-polar0 outline-none">
                </div>

                <button type="submit"
                    class="py-3 w-full rounded-lg bg-frost3 transition-colors hover:bg-frost2 focus:bg-frost2">
                    Ganti Password
                </button>
            </form>
        </div>

        {{-- Spacer --}}
        <div class="hidden md:block"></div>
    </div>
@endsection
