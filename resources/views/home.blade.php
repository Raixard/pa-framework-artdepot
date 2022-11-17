@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    
    <div class="container my-6 mt-20 mx-auto px-6 space-y-6 sm:px-auto">
        @if (session('error'))
        <div class="bg-aurora0 px-3 py-6 w-full rounded-lg">
            <b>Ups!</b> {{ session('error') }}
        </div>
        @endif

        {{-- Success Alert --}}
        @if (session('success'))
        <div class="bg-aurora3/40 px-3 py-6 w-full rounded-lg">
            <b>Yeah!</b> {{ session('success') }}
        </div>
        @endif
        <h1 class="text-2xl font-bold">
            @if ($title == 'followed')
                Karya dari Pengguna yang Diikuti
            @else
                Jelajah Karya
            @endif
        </h1>
        <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
            @foreach ($creations as $creation)
                @include('components.creation-card', ['creation' => $creation])
            @endforeach
        </div>
        @if (Auth::user())
            @if (Auth::user()->role == 'user')
            <hr>
            <form action="{{route('sendReport')}}" method="POST">
                @csrf
                <h2 class="text-xl font-bold">Tempat Laporan</h2>
                <input type="hidden" name="user" value="{{Auth::user()->id}}">
                <div class="flex flex-col w-3/4 space-y-3 mb-6">
                    <label for="report" class="font-medium">Report*</label>
                    <textarea type="text" placeholder="Berikan Aduan Anda" name="report" id="create-report" rows="2" required
                        class="p-3 rounded-lg text-polar0 outline-none resize-none"></textarea>
                </div>
                <div class="flex flex-col w-3/4 space-y-3 mb-6">
                    <label for="create-categories" class="font-medium">Jenis Laporan*</label>
                    <select name="jenis" id="create-categories" required
                        class="p-3 rounded-lg text-polar0 outline-none resize-none">
                        <option value="">Pilih Jenis Laporan</option>
                        @foreach ($jenis as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->category }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="py-3 w-1/6 rounded-lg bg-frost3 transition-colors hover:bg-frost2 focus:bg-frost2">
                    Submit
                </button>
            </form>
            @endif
        @endif
    </div>
@endsection
