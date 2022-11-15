@extends('layouts.global')

@section('title')
    Pencarian | ArtDepot
@endsection

@section('content')
    <div class="container flex flex-col my-6 mt-20 mx-auto px-6 space-y-3 sm:px-auto">
        {{-- Title --}}
        <h1 class="text-2xl font-bold">
            Mencari "{{ $_GET['q'] }}" ({{ count($creations) }} ditemukan)
        </h1>

        {{-- Subtitle --}}
        <span class="text-snow2/70 italic text-sm">
            Anda juga dapat mencari berdasarkan pengirim dengan kata kunci @by:username
        </span>

        {{-- Content --}}
        @if (count($creations) > 0)
            <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
                @foreach ($creations as $creation)
                    @include('components.creation-card', ['creation' => $creation])
                @endforeach
            </div>
        @else
            <span class="text-lg">
                Tidak dapat menemukan karya sesuai kata kunci...
            </span>
        @endif
    </div>
@endsection
