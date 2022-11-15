{{-- Navbar Background --}}
<nav class="fixed top-0 left-0 right-0 h-14 drop-shadow-md bg-polar0 z-10">
    {{-- Navbar Container --}}
    <div class="container h-full px-4 py-2 mx-auto flex justify-between items-center">
        {{-- Hamburger Menu Button --}}
        <div class="md:hidden">
            <button id="btn-burger" class="block hamburger md:hidden">
                <span class="hamburger-top"></span>
                <span class="hamburger-middle"></span>
                <span class="hamburger-bottom"></span>
            </button>
        </div>

        {{-- Left Group (Desktop) --}}
        <div class="flex space-x-4 items-center">
            {{-- Website Logo --}}
            <div class="flex self-center h-8">
                <a href="{{ url('/') }}" class="flex md:mr-8">
                    <img src="{{ asset('/img/ui/ArtDepot_LogoFull.png') }}" alt="ArtDepot Logo" class="object-contain">
                </a>
            </div>

            {{-- Navigation (Desktop) --}}
            <div class="hidden md:flex items-center">
                <a href="{{ url('/') }}"
                    class="opacity-70 px-4 py-2 rounded-lg font-medium transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Jelajah
                </a>
                @if (Auth::user())
                    <a href="{{ route('creationShowFollowed') }}"
                        class="opacity-70 px-4 py-2 rounded-lg font-medium transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                        tabindex="0">
                        Diikuti
                    </a>
                @endif
                <a href=""
                    class="opacity-70 px-4 py-2 rounded-lg font-medium transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Kategori
                </a>

                {{-- Search Button --}}
                <div class="hidden md:flex md:items-center lg:hidden">
                    <button id="btn-search"
                        class="opacity-70 px-4 py-2 font-medium rounded-lg transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                        title="Pencarian">
                        <span class="bi-search"></span>
                    </button>
                </div>

                {{-- Search Bar --}}
                <form action="{{ route('creationSearch') }}" method="GET" class="hidden relative ml-4 lg:block">
                    <div class="pointer-events-none absolute z-10 inset-y-0 left-0 flex items-center pl-2 transition">
                        <span class="bi-search text-polar1"></span>
                    </div>
                    <input type="search"
                        class="block bg-snow2 text-polar1 pl-8 py-2 pr-2 opacity-70 rounded-lg outline-none transition hover:opacity-100 focus:opacity-100"
                        placeholder="Cari karya..." name="q" value="{{ $_GET['q'] ?? '' }}">
                </form>
            </div>
        </div>

        {{-- Right Group (Desktop) --}}
        <div class="flex space-x-4 items-center">
            {{-- Profile Picture --}}
            <div class="relative">
                <button id="btn-profile"
                    class="relative flex items-center w-8 h-8 aspect-square rounded-full ring-snow2 hover:ring-2 focus:ring-2">
                    <img src="{{ asset('img/users/' . (Auth::user() ? Auth::user()->profile_image : 'user-default.jpg')) }}"
                        alt="" class="absolute object-cover rounded-full">
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
                                    {{ Auth::user()->username }}
                                </p>
                            </div>

                            {{-- Menu --}}
                            <a href="{{ route('userShow', Auth::user()->username) }}"
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Profil
                            </a>
                            <a href="{{ route('userEdit', Auth::user()->username) }}"
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Edit Profil
                            </a>
                            <a href="{{ route('userShowLiked', Auth::user()->username) }}"
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Karya Disukai
                            </a>
                            @if (Auth::user()->role == 'admin')
                                <a href=""
                                    class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                    tabindex="0">
                                    Menu Admin
                                </a>
                            @endif
                            <hr class="my-2">
                            <a href="{{ route('logout') }}"
                                class="opacity-70 px-4 py-2 font-medium transition hover:opacity-100 hover:bg-aurora0 focus:opacity-100 focus:bg-aurora0"
                                tabindex="0">
                                Keluar
                            </a>
                        @else
                            {{-- Apabila user belum login --}}
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 font-medium whitespace-nowrap transition bg-frost3 hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Registrasi
                            </a>
                            <a href="{{ route('login') }}"
                                class="opacity-70 px-4 py-2 font-medium whitespace-nowrap transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                                tabindex="0">
                                Login
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Create Post Button (Desktop) --}}
            @if (Auth::user())
                <a href="{{ route('creationCreate') }}"
                    class="hidden bg-frost3 px-3 py-2 rounded-lg font-medium transition-colors md:block hover:bg-frost2">
                    <i class="bi-plus-lg mr-2"></i>Buat Post
                </a>
            @endif
        </div>
    </div>

    {{-- Search Menu (Large) --}}
    <div class="hidden md:block lg:hidden">
        <div id="search-bar-large" class="flex hidden p-4 bg-polar0 origin-top scale-y-0 transition-transform">
            <form action="{{ route('creationSearch') }}" method="GET" class="relative w-full">
                <div class="pointer-events-none absolute z-10 inset-y-0 left-0 flex items-center pl-2 transition">
                    <span class="bi-search text-polar1"></span>
                </div>
                <input type="search"
                    class="block w-full bg-snow2 text-polar1 pl-8 py-2 pr-2 opacity-70 rounded-lg outline-none transition hover:opacity-100 focus:opacity-100"
                    placeholder="Cari karya..." name="q" value="{{ $_GET['q'] ?? '' }}">
            </form>
        </div>
    </div>

    {{-- Profile Menu (Mobile) --}}
    <div class="md:hidden">
        <div
            class="profile-menu flex hidden scale-y-0 absolute drop-shadow-md bg-polar0 w-full max-h-almostscreen py-4 flex-col overflow-y-auto items-center origin-top transition-transform">
            @if (Auth::user())
                {{-- Apabila user telah login --}}
                {{-- Username --}}
                <p class="w-full py-4 font-medium text-center text-xl">
                    {{ Auth::user()->username }}
                </p>
                {{-- Profile Navigation --}}
                <a href="{{ route('creationCreate') }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    <i class="bi-plus-lg mr-2"></i>Buat Post
                </a>
                <a href="{{ route('userShow', Auth::user()->username) }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Profil
                </a>
                <a href="{{ route('userEdit', Auth::user()->username) }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Edit Profil
                </a>
                <a href="{{ route('userShowLiked', Auth::user()->username) }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Karya Disukai
                </a>
                @if (Auth::user()->role == 'admin')
                    <a href=""
                        class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                        tabindex="0">
                        Menu Admin
                    </a>
                @endif
                <hr class="my-2 w-full">
                <a href="{{ route('logout') }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:bg-aurora0 focus:opacity-100 focus:bg-aurora0"
                    tabindex="0">
                    Keluar
                </a>
            @else
                {{-- Apabila user belum login --}}
                <a href="{{ route('register') }}"
                    class="w-full py-4 font-medium text-center text-xl transition bg-frost3 hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Registrasi
                </a>
                <a href="{{ route('login') }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Login
                </a>
            @endif
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="md:hidden">
        <div id="burger-menu"
            class="flex hidden absolute drop-shadow-md bg-polar0 w-full max-h-almostscreen py-4 flex-col items-center origin-top scale-y-0 overflow-y-auto transition-transform">
            {{-- Search Bar (Mobile) --}}
            <form action="{{ route('creationSearch') }}" method="GET" class="relative w-full px-4 mb-4">
                <div class="pointer-events-none absolute z-10 inset-y-0 left-0 flex items-center pl-6 transition">
                    <span class="bi-search text-polar1"></span>
                </div>
                <input type="search"
                    class="block w-full bg-snow2 text-polar1 pl-8 py-2 pr-2 opacity-70 rounded-lg outline-none transition hover:opacity-100 focus:opacity-100"
                    placeholder="Cari karya..." name="q" value="{{ $_GET['q'] ?? '' }}">
            </form>
            {{-- Mobile Navigation --}}
            <a href="{{ url('/') }}"
                class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                tabindex="0">
                Jelajahi
            </a>
            @if (Auth::user())
                <a href="{{ route('creationShowFollowed') }}"
                    class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                    tabindex="0">
                    Diikuti
                </a>
            @endif
            <a href=""
                class="opacity-70 w-full py-4 font-medium text-center text-xl transition hover:opacity-100 hover:text-frost1 hover:bg-gray-800 focus:opacity-100 focus:text-frost1 focus:bg-gray-800"
                tabindex="0">
                Kategori
            </a>
        </div>
    </div>
</nav>
