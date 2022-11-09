<div class="flex flex-col space-y-2">
    {{-- Creation Image and Title (When Hovered) --}}
    <a href="{{ url('/show') }}" class="group relative flex aspect-square rounded-lg outline-none" tabindex="0">
        <img src="https://picsum.photos/id/1/{{ rand(400, 1000) }}/{{ rand(400, 1000) }}"
            class="absolute object-cover w-full h-full rounded-lg">
        <div class="absolute flex justify-start items-end w-full h-full px-4 py-2 bg-gradient-to-t from-polar0 to-transparent opacity-0 transition-opacity group-hover:opacity-100 group-focus:opacity-100">
            <span class="font-medium">Judul Berjudulan</span>
        </div>
    </a>

    {{-- Creation Poster, and Like and Comment Counters --}}
    <div class="flex flex-row justify-between items-center">
        {{-- Poster Profile Image and Username --}}
        <div class="flex items-center space-x-2 min-w-0 {{ $creationPoster ?? '' }}">
            <a href=""
                class="peer relative flex items-center w-8 h-8 aspect-square rounded-full outline-none">
                <img src="{{ asset('img/users/user-default.jpg') }}" alt=""
                    class="absolute object-cover rounded-full">
            </a>
            <a href="" class="font-medium truncate outline-none transition-colors hover:text-frost3 focus:text-frost3 peer-hover:text-frost3" tabindex="0">
                Jayatoyaburriwcawcwacadawdaw
            </a>
        </div>

        {{-- Creation Likes and Comment Counters --}}
        <div class="group flex justify-end flex-nowrap space-x-2 {{ $likesAndComments ?? '' }}">
            <i class="bi bi-chat-dots group-hover:text-aurora2"></i><span class="transition-colors group-hover:text-aurora2">80</span>
            <i class="bi bi-heart group-hover:text-aurora0"></i><span class="transition-colors group-hover:text-aurora0">20</span>
        </div>
    </div>
</div>
