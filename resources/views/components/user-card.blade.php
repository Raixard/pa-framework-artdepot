<div class="p-6 space-y-3 shrink-0 flex flex-col items-center rounded-lg lg:basis-80 lg:bg-polar3">
    {{-- User Profile Image and Username --}}
    <div class="flex flex-col items-center">
        {{-- Profile Image --}}
        <div class="flex items-center max-w-[128px] max-h-[128px] aspect-square rounded-full">
            <img src="{{ asset('img/users/' . $user->profile_image) }}" alt="" class="object-cover rounded-full">
        </div>

        {{-- Username --}}
        <h3 class="text-2xl font-bold">
            {{ $user->username }}
        </h3>
    </div>

    {{-- Bio --}}
    <p class="text-center">
        {!! nl2br(e($user->biography)) !!}
    </p>

    {{-- Edit Button --}}
    @if (Auth::user())
        @if (Auth::user()->id == $user->id)
            <a href="{{ route('userEdit', $user->username) }}"
                class="bg-frost3 w-full py-2 px-3 rounded-lg font-medium text-center hover:bg-frost2 focus:bg-frost2"
                tabindex="0">
                <i class="bi-pencil mr-2"></i>Edit Profil
            </a>
        @endif
    @endif

    {{-- Follow Button --}}
    @if (Auth::user())
        @if (Auth::user()->id != $user->id)
            @if ($isFollowing)
                {{-- Follow Button --}}
                <form action="{{ route('followDestroy', $user->id) }}" method="POST" class="w-full">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="w-full py-2 px-3 border rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-aurora0 focus:bg-aurora0"
                        tabindex="0">
                        <i class="bi-person-dash mr-2"></i>Diikuti
                    </button>
                </form>
            @else
                {{-- Unfollow Button --}}
                <form action="{{ route('followStore', $user->id) }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="bg-frost3 w-full py-2 px-3 rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-frost2 focus:bg-frost2"
                        tabindex="0">
                        <i class="bi-person-plus mr-2"></i>Ikuti
                    </button>
                </form>
            @endif
        @endif
    @endif

    {{-- Stats --}}
    <div class="w-full space-x-6 flex justify-between">
        <div class="flex flex-col">
            <span>Karya</span>
            <span>Suka Didapat</span>
            <span>Komentar Didapat</span>
        </div>
        <div class="flex flex-col font-medium">
            <span>{{ $creations->count() }}</span>
            <span>{{ $likesReceived }}</span>
            <span>{{ $commentsReceived }}</span>
        </div>
    </div>

    {{-- Followers --}}
    <div class="w-full space-y-1">
        <h3 class="font-bold">
            Pengikut ({{ $followers->count() }})
        </h3>
        <div class="flex w-full relative space-x-1">
            @if ($followers->count() > 0)
                @foreach ($followers->take(6) as $follower)
                    <div>
                        <a href="{{ route('userShow', $follower->username) }}"
                            class="peer relative flex items-center w-8 h-8 aspect-square rounded-full outline-none"
                            tabindex="-1" title="{{ $follower->username }}">
                            <img src="{{ asset('img/users/' . $follower->profile_image) }}"
                                alt="{{ $follower->username }}" class="absolute object-cover rounded-full">
                        </a>
                        <span class="hidden absolute px-3 py-1 top-10 bg-polar0 rounded-lg peer-hover:block">
                            {{ $follower->username }}
                        </span>
                    </div>
                @endforeach
            @else
                <span class="text-snow2/70 italic">
                    Pengguna ini tidak memiliki pengikut...
                </span>
            @endif
        </div>
    </div>

    {{-- Followings --}}
    <div class="w-full space-y-1">
        <h3 class="font-bold">
            Diikuti ({{ $followings->count() }})
        </h3>
        <div class="flex w-full relative space-x-1">
            @if ($followings->count() > 0)
                @foreach ($followings->take(6) as $following)
                    <div>
                        <a href="{{ route('userShow', $following->username) }}"
                            class="peer relative flex items-center w-8 h-8 aspect-square rounded-full outline-none"
                            tabindex="-1" title="{{ $following->username }}">
                            <img src="{{ asset('img/users/' . $following->profile_image) }}"
                                alt="{{ $following->username }}" class="absolute object-cover rounded-full">
                        </a>
                        <span class="hidden absolute px-3 py-1 top-10 bg-polar0 rounded-lg peer-hover:block">
                            {{ $following->username }}
                        </span>
                    </div>
                @endforeach
            @else
                <span class="text-snow2/70 italic">
                    Pengguna ini tidak mengikuti siapapun...
                </span>
            @endif
        </div>
    </div>
</div>
