@extends('layouts.global')

@section('title')
    Edit Post | ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto grid md:grid-cols-4 auto-cols-fr">
        {{-- Spacer --}}
        <div class="hidden md:block"></div>

        {{-- Login Section --}}
        <div class="flex flex-col items-center rounded-lg px-6 py-6 space-y-3 bg-polar2 md:col-span-2">
            {{-- Title --}}
            <h1 class="font-bold text-2xl">Buat Post</h1>

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
                <img src="{{ asset('img/creations/' . $creation->image_url) }}" class="w-1/2"
                    alt="{{ $creation->title }}">
            </div>

            {{-- Creation Form --}}
            <form action="{{ route('creationUpdate', $creation->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('put')
                {{-- Image Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="create-image" class="font-medium">File Gambar</label>
                    <input type="file" name="image" id="create-image" accept=".jpg, .jpeg, .png, .gif">
                    <span class="font-light italic text-sm">
                        Gambar dengan dimensi melebihi 1280x1280 akan otomatis diperkecil
                    </span>
                </div>

                {{-- Title Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="create-title" class="font-medium">Judul*</label>
                    <input type="text" placeholder="Masukkan judul karya..." name="title" id="create-title"
                        maxlength="64" value="{{ $creation->title }}" required class="p-3 rounded-lg text-polar0 outline-none">
                </div>

                {{-- Description Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="create-description" class="font-medium">Deskripsi*</label>
                    <textarea type="text" placeholder="Masukkan deskripsi karya..." name="description" id="create-description" rows="6" required
                        class="p-3 rounded-lg text-polar0 outline-none resize-none">{{ $creation->description }}</textarea>
                </div>

                {{-- Categories Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="create-description" class="font-medium">Kategori*</label>
                    <select name="categories" id="create-categories"
                        required class="p-3 rounded-lg text-polar0 outline-none resize-none">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $categ) 
                            <option value="{{$categ->id}}" {{$creation->category_id == $categ->id ? 'selected':''}}>{{$categ->category_name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Keywords Input --}}
                <div class="flex flex-col w-full space-y-3 mb-6">
                    <label for="create-keywords" class="font-medium">Keywords</label>
                    <input type="text" placeholder="Masukkan keywords karya..." name="keywords" id="create-keywords"
                        value="{{ $creation->keywords }}" class="p-3 rounded-lg text-polar0 outline-none">
                    <span class="font-light italic text-sm">
                        Keywords dipisahkan dengan tanda titik koma atau semikolon (;)
                    </span>
                </div>

                {{-- Update Button --}}
                <button type="submit"
                    class="py-3 w-full rounded-lg bg-frost3 transition-colors hover:bg-frost2 focus:bg-frost2">
                    Perbarui
                </button>
            </form>
        </div>

        {{-- Spacer --}}
        <div class="hidden md:block"></div>
    </div>
@endsection
