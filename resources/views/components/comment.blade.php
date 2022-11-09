{{-- Comment --}}
<div class="flex flex-col space-y-2">
    {{-- Comment Position --}}
    <div class="flex space-x-3 {{ $margin ? 'ml-8' : '' }}">
        {{-- Commenter Profile Image --}}
        <a href="" class="relative flex items-center w-12 h-12 aspect-square rounded-full">
            <img src="{{ asset('img/users/user-default.jpg') }}" alt="" class="absolute object-cover rounded-full">
        </a>

        {{-- Comment Content --}}
        <div class="flex flex-col w-full bg-polar1 py-3 px-6 rounded-lg">
            {{-- Commenter Username and Comment Date --}}
            <div class="flex flex-col mb-2 sm:flex-row sm:justify-between sm:items-center">
                <a href=""
                    class="font-medium truncate transition-colors hover:text-frost3 focus:text-frost3"
                    tabindex="0">
                    Jayatoyaburriwcawcwacadawdaw
                </a>
                <p class="text-snow2/70 text-sm">10 hari yang lalu</p>
            </div>

            {{-- Comment Content --}}
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit recusandae ratione possimus
                commodi deserunt, obcaecati exercitationem aliquam qui ut! Laboriosam odio atque nam corrupti aliquid
                iure quas repellat, inventore sequi!
            </p>
        </div>
    </div>

    {{-- Comment Actions --}}
    <div class="flex justify-end space-x-3">
        {{-- Delete Button --}}
        <form action="" method="POST"
            onsubmit="return confirm('Apakah kamu yakin ingin menghapus komentar ini?')">
            @csrf
            @method('delete')
            <button type="submit" class="px-3 py-1 rounded-lg text-aurora0 transition-colors hover:bg-aurora0/70 hover:text-snow2 focus:bg-aurora0/70 focus:text-snow2" tabindex="0">Hapus</button>
        </form>

        {{-- Reply Button --}}
        <button class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-gray-800 focus:bg-gray-800" tabindex="0">Balas</button>
    </div>
</div>
