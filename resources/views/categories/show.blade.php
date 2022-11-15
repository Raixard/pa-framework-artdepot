@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 space-y-6 sm:px-auto">
        <h1 class="text-2xl font-bold">
            Kategori: {{$category->category_name}}
        </h1>
        <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
            @foreach ($creations as $creation)
                @include('components.creation-card', ['creation' => $creation])
            @endforeach
        </div>
    </div>
@endsection
