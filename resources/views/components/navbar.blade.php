{{-- Navbar Background --}}
<nav class="relative drop-shadow-md bg-polar0">
    {{-- Navbar Container --}}
    <div class="container px-4 py-2 mx-auto flex justify-between items-center">
        {{-- Hamburger Menu Button --}}
        <div class="md:hidden">
            <button id="btn-burger" class="block hamburger md:hidden focus:outline-none">
                <span class="hamburger-top"></span>
                <span class="hamburger-middle"></span>
                <span class="hamburger-bottom"></span>
            </button>
        </div>

        {{-- Left Group (Desktop) --}}
        <div class="flex space-x-4 items-center">
            {{-- Website Logo --}}
            <a href="{{ url('/') }}" class="font-bold text-xl select-none md:mr-8">
                ArtDepot
            </a>

            {{-- Navigation (Desktop) --}}
            <div class="hidden md:flex items-center">
                <a href=""
                    class="opacity-70 px-4 py-2 rounded-lg font-medium transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Jelajahi
                </a>
                <a href=""
                    class="opacity-70 px-4 py-2 rounded-lg font-medium transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Diikuti
                </a>
                <a href=""
                    class="opacity-70 px-4 py-2 rounded-lg font-medium transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Kategori
                </a>

                {{-- Search Button --}}
                <div class="hidden ml-4 md:flex md:items-center lg:hidden">
                    <button id="btn-search"
                        class="opacity-70 font-medium transition hover:opacity-100 hover:text-frost1">
                        <span class="bi-search"></span>
                    </button>
                </div>

                {{-- Search Bar --}}
                <form action="/" method="GET" class="hidden relative ml-4 lg:block">
                    <div class="pointer-events-none absolute z-10 inset-y-0 left-0 flex items-center pl-2 transition">
                        <span class="bi-search text-polar1"></span>
                    </div>
                    <input type="search"
                        class="block bg-snow2 text-polar1 pl-8 py-2 pr-2 opacity-70 outline-none rounded-lg transition hover:opacity-100 focus:opacity-100"
                        placeholder="Cari karya..." name="q">
                </form>
            </div>
        </div>

        {{-- Right Group (Desktop) --}}
        <div class="flex space-x-4 items-center">
            {{-- Profile Picture --}}
            <div class="relative">
                <button id="btn-profile"
                    class="relative flex items-center w-8 h-8 aspect-square rounded-full outline-none ring-snow2 focus:ring-2">
                    <img src="{{ asset('img/users/user-default.jpg') }}" alt=""
                        class="absolute object-cover rounded-full">
                </button>

                {{-- Profile Menu (Desktop) --}}
                <div class="hidden md:block">
                    <div
                        class="profile-menu w-60 flex hidden scale-y-0 absolute flex-col mt-2 py-2 right-0 z-10 rounded-lg bg-polar1 drop-shadow-md origin-top-right transition-transform">
                        @if (Auth::user())
                            {{-- Apabila user telah login --}}
                            {{-- Username --}}
                            <div class="flex">
                                <p class="pl-4 py-2 font-medium truncate min-w-0">
                                    usernametestingtesting
                                </p>
                            </div>

                            {{-- Menu --}}
                            <a href=""
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Profil
                            </a>
                            <a href=""
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Edit Profil
                            </a>
                            <a href=""
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Karya Disukai
                            </a>
                            <hr class="my-2">
                            <a href=""
                                class="opacity-70 px-4 py-2 font-medium transition outline-none hover:opacity-100 hover:bg-aurora0 focus:opacity-100 focus:bg-aurora0"
                                tabindex="0">
                                Keluar
                            </a>
                        @else
                            {{-- Apabila user belum login --}}
                            <a href=""
                                class="px-4 py-2 font-medium whitespace-nowrap transition outline-none bg-frost3 hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Registrasi
                            </a>
                            <a href=""
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Login
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Create Post Button (Desktop) --}}
            @if (Auth::user())
                <a href=""
                    class="hidden bg-frost3 px-3 py-2 rounded-lg font-semibold transition-colors md:block hover:bg-frost2">
                    <i class="bi-plus-lg mr-2"></i>Buat Post
                </a>
            @endif
        </div>
    </div>

    {{-- Search Menu (Large) --}}
    <div class="hidden md:block lg:hidden">
        <div id="search-bar-large" class="flex hidden p-4 origin-top scale-y-0 transition-transform">
            <form action="/" method="GET" class="relative w-full">
                <div class="pointer-events-none absolute z-10 inset-y-0 left-0 flex items-center pl-2 transition">
                    <span class="bi-search text-polar1"></span>
                </div>
                <input type="search"
                    class="block w-full bg-snow2 text-polar1 pl-8 py-2 pr-2 opacity-70 outline-none rounded-lg transition hover:opacity-100 focus:opacity-100"
                    placeholder="Cari karya..." name="q">
            </form>
        </div>
    </div>

    {{-- Profile Menu (Mobile) --}}
    <div class="md:hidden">
        <div
            class="profile-menu flex hidden scale-y-0 absolute drop-shadow-md bg-polar0 w-full py-4 flex-col items-center origin-top transition-transform">
            @if (Auth::user())
                {{-- Apabila user telah login --}}
                {{-- Username --}}
                <p class="w-full py-4 font-medium text-center text-xl">
                    Usernamedoank
                </p>
                {{-- Profile Navigation --}}
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    <i class="bi-plus-lg mr-2"></i>Buat Post
                </a>
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Profil
                </a>
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Edit Profil
                </a>
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Karya Disukai
                </a>
                <hr class="my-2 w-full">
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:bg-aurora0 focus:opacity-100 focus:bg-aurora0"
                    tabindex="0">
                    Keluar
                </a>
            @else
                {{-- Apabila user belum login --}}
                <a href=""
                    class="w-full py-4 font-medium text-center text-xl transition outline-none bg-frost3 hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Registrasi
                </a>
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Login
                </a>
            @endif
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="md:hidden">
        <div id="burger-menu"
            class="flex hidden absolute drop-shadow-md bg-polar0 w-full py-4 flex-col items-center origin-top scale-y-0 transition-transform">
            {{-- Search Bar (Mobile) --}}
            <form action="/" method="GET" class="relative w-full px-4 mb-4">
                <div class="pointer-events-none absolute z-10 inset-y-0 left-0 flex items-center pl-6 transition">
                    <span class="bi-search text-polar1"></span>
                </div>
                <input type="search"
                    class="block w-full bg-snow2 text-polar1 pl-8 py-2 pr-2 opacity-70 outline-none rounded-lg transition hover:opacity-100 focus:opacity-100"
                    placeholder="Cari karya..." name="q">
            </form>
            {{-- Mobile Navigation --}}
            <a href=""
                class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                tabindex="0">
                Jelajahi
            </a>
            @if (Auth::user())
                <a href=""
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Diikuti
                </a>
            @endif
            <a href=""
                class="opacity-70 w-full py-4 font-medium text-center text-xl transition outline-none hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                tabindex="0">
                Kategori
            </a>
        </div>
    </div>
</nav>
