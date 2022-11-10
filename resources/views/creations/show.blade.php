@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="flex flex-col container mx-auto px-6 sm:px-auto">
        <div class="mt-14"></div>

        {{-- Creation Image --}}
        <div class="flex flex-col my-3">
            <div class="w-full max-w-full max-h-[100vh] flex justify-center">
                <img src="https://picsum.photos/id/1/{{ rand(400, 1000) }}/{{ rand(400, 1000) }}" alt=""
                    class="object-contain">
            </div>
        </div>

        {{-- Details & Other Creations --}}
        <div class="flex flex-col pb-6 space-y-6 lg:space-y-0 lg:flex-row">
            {{-- Creation Details --}}
            <div class="flex flex-col basis-3/4 space-y-6 px-0 lg:px-10">
                <hr>

                {{-- Creation Poster --}}
                <div class="flex space-x-4 min-w-0">
                    {{-- Poster Profile Image --}}
                    <a href="" class="relative flex items-center w-12 h-12 aspect-square rounded-full outline-none">
                        <img src="{{ asset('img/users/user-default.jpg') }}" alt=""
                            class="absolute object-cover rounded-full">
                    </a>

                    {{-- Title & Username --}}
                    <div class="flex flex-col space-y-1">
                        {{-- Creation Title --}}
                        <h1 class="font-bold text-xl">
                            Judul
                        </h1>

                        {{-- Creation Username --}}
                        <div>
                            <span>oleh </span>
                            <a href=""
                                class="font-medium truncate outline-none transition-colors hover:text-frost3 focus:text-frost3"
                                tabindex="0">
                                Jayatoyaburriwcawcwacadawdaw
                            </a>
                        </div>

                        {{-- Follow Button --}}
                        <form action="">
                            <button
                                class="bg-frost3 py-1 px-3 rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-frost2 focus:bg-frost2"
                                tabindex="0">
                                <i class="bi-person-plus mr-2"></i>Ikuti
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Creation Date Details --}}
                <div class="flex flex-col text-snow2/70 italic">
                    <div>
                        <span>Dipublikasikan: </span>
                        <span>12 hari yang lalu</span>
                    </div>

                    <div>
                        <span>Diperbarui: </span>
                        <span>11 hari yang lalu</span>
                    </div>
                </div>

                {{-- Like and Comment Counter --}}
                <div class="flex space-x-4">
                    <div><i class="bi bi-heart mr-2"></i>200 disukai</div>
                    <div><i class="bi bi-chat-dots mr-2"></i>200 komentar</div>
                </div>

                {{-- Creation Keywords --}}
                <div class="flex space-x-2">
                    @foreach (explode(';', 'keren; mantap; sangat hebat; uwaw;;;') as $keyword)
                        @if (!empty($keyword))
                            <span
                                class="px-3 py-1 bg-polar3/70 rounded-lg cursor-pointer transition-colors hover:bg-polar3">
                                {{ $keyword }}
                            </span>
                        @endif
                    @endforeach
                </div>

                {{-- Creation Description --}}
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto optio excepturi dolore! Omnis est
                    aut odio nulla nam repellendus. Asperiores eos illo quae. Consequuntur quo atque ratione tempore
                    sapiente totam.
                </p>

                <hr>

                {{-- Comments --}}
                <div>
                    <h3 class="font-bold mb-6">Komentar (8)</h3>
                    @if (Auth::user())
                        @include('components.comment-editor')
                    @endif
                    <div class="mb-6"></div>
                    <div class="flex flex-col space-y-3">
                        @for ($i = 0; $i < 8; $i++)
                            @include('components.comment', ['margin' => rand(0, 1) == 0])
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Other Creations --}}
            <div class="flex flex-col basis-1/4 space-y-6">
                <h3 class="font-bold">Lainnya oleh pengguna ini</h3>
                <div class="grid gap-x-3 gap-y-3 grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                    @for ($i = 0; $i < 6; $i++)
                        @include('components.creation-card', [
                            'creationPoster' => 'hidden',
                            'likesAndComments' => 'hidden',
                        ])
                    @endfor
                </div>
            </div>
        </div>

    </div>
@endsection
