@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto">
        <div class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
            @for ($i = 0; $i < 16; $i++)
                @include('components.creation-card')
            @endfor
        </div>
    </div>
@endsection
