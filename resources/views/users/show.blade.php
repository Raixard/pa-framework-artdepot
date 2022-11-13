@extends('layouts.global')

@section('title')
    {{ $user->username }} | ArtDepot
@endsection

@section('content')
    <div class="flex flex-col justify-between container mx-auto mt-14 py-6 px-6 sm:px-auto lg:flex-row lg:space-x-6">
        {{-- User Card --}}
        @include('components.user-card')

        <div class="flex flex-col w-full space-y-3">
            {{-- Navigation --}}
            <div class="flex space-x-3 justify-center lg:justify-start">
                <a href="{{ route('userShow', $user->username) }}"
                    class="py-2 px-3 border rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2 {{ $purpose == 'gallery' ? 'bg-frost2' : '' }}"
                    tabindex="0">
                    Galeri
                </a>
                <a href="{{ route('userShowLiked', $user->username) }}"
                    class="py-2 px-3 border rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2 {{ $purpose == 'liked' ? 'bg-frost2' : '' }}"
                    tabindex="0">
                    Disukai
                </a>
                <a href="{{ route('userShowFollowers', $user->username) }}"
                    class="py-2 px-3 border rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2 {{ $purpose == 'followers' ? 'bg-frost2' : '' }}"
                    tabindex="0">
                    Pengikut
                </a>
                <a href="{{ route('userShowFollowings', $user->username) }}"
                    class="py-2 px-3 border rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2 {{ $purpose == 'followings' ? 'bg-frost2' : '' }}"
                    tabindex="0">
                    Diikuti
                </a>
            </div>

            {{-- Content --}}
            @if ($purpose == 'gallery')
                {{-- Creation Gallery --}}
                @if ($creations->count() > 0)
                    <div
                        class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
                        @foreach ($creations as $creation)
                            @include('components.creation-card', [
                                'creation' => $creation,
                                'creationPoster' => 'hidden',
                            ])
                        @endforeach
                    </div>
                @else
                    <span class="text-snow2/70 italic">
                        Pengguna ini belum memublikasikan karya...
                    </span>
                @endif
            @elseif ($purpose == 'liked')
                {{-- Liked Creations --}}
                @if ($likedCreations->count() > 0)
                    <div
                        class="grid gap-x-6 gap-y-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
                        @foreach ($likedCreations as $creation)
                            @include('components.creation-card', ['creation' => $creation])
                        @endforeach
                    </div>
                @else
                    <span class="text-snow2/70 italic">
                        Pengguna ini belum ada menyukai karya...
                    </span>
                @endif
            @elseif ($purpose == 'followers')
                {{-- Followers --}}
                @if ($followers->count() > 0)
                    <div
                        class="grid gap-x-6 gap-y-8 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 2xl:grid-cols-6">
                        @foreach ($followers as $follower)
                            <div class="flex space-x-2 items-center">
                                <a href="{{ route('userShow', $follower->username) }}"
                                    class="peer relative flex items-center w-8 h-8 aspect-square rounded-full outline-none">
                                    <img src="{{ asset('img/users/' . $follower->profile_image) }}"
                                        alt="{{ $follower->username }}" class="absolute object-cover rounded-full">
                                </a>
                                <a href="{{ route('userShow', $follower->username) }}"
                                    class="font-medium truncate outline-none transition-colors hover:text-frost3 focus:text-frost3 peer-hover:text-frost3"
                                    tabindex="0">
                                    {{ $follower->username }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <span class="text-snow2/70 italic">
                        Pengguna ini tidak memiliki pengikut...
                    </span>
                @endif
            @elseif ($purpose == 'followings')
                {{-- Followings --}}
                @if ($followings->count() > 0)
                    <div
                        class="grid gap-x-6 gap-y-8 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 2xl:grid-cols-6">
                        @foreach ($followings as $following)
                            <div class="flex space-x-2 items-center">
                                <a href="{{ route('userShow', $following->username) }}"
                                    class="peer relative flex items-center w-8 h-8 aspect-square rounded-full outline-none">
                                    <img src="{{ asset('img/users/' . $following->profile_image) }}"
                                        alt="{{ $following->username }}" class="absolute object-cover rounded-full">
                                </a>
                                <a href="{{ route('userShow', $following->username) }}"
                                    class="font-medium truncate outline-none transition-colors hover:text-frost3 focus:text-frost3 peer-hover:text-frost3"
                                    tabindex="0">
                                    {{ $following->username }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <span class="text-snow2/70 italic">
                        Pengguna ini tidak mengikuti siapapun...
                    </span>
                @endif
            @endif
        </div>
    </div>
@endsection
