@extends('layouts.global')

@section('title')
    {{ $creation->title }} oleh {{ $creation->user->username }} | ArtDepot
@endsection

@section('content')
    <div class="flex flex-col container mx-auto px-6 sm:px-auto">
        <div class="mt-14"></div>

        {{-- Creation Image --}}
        <div class="flex flex-col space-y-3 my-3">
            {{-- Creation Image --}}
            <div class="w-full max-w-full max-h-[100vh] flex justify-center">
                <img src="{{ asset('img/creations/' . $creation->image_url) }}"
                    alt="{{ $creation->title }} oleh {{ $creation->user->username }}" class="object-contain">
            </div>

            {{-- Creation Action Buttons --}}
            <div class="flex justify-center space-x-3">
                @if (Auth::user())
                    {{-- Edit Button --}}
                    @if (Auth::user()->id == $creation->user_id)
                        <a href="{{ route('creationEdit', $creation->id) }}"
                            class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2">
                            <i class="bi bi-pencil mr-2"></i>
                            Perbarui
                        </a>
                        <form action="{{ route('creationDestroy', $creation->id) }}" method="POST"
                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus post ini? Post yang sudah dihapus tidak dapat dikembalikan lagi!')">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="px-3 py-1 bg-aurora0 rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2"
                                tabindex="0">
                                <i class="bi bi-trash mr-2"></i>
                                Hapus
                            </button>
                        </form>
                    @endif

                    {{-- Like Button --}}
                    @if ($creation->likes->where('user_id', Auth::user()->id)->count() < 1)
                        <form action="{{ route('likeStore', $creation->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2"
                                tabindex="0">
                                <i class="bi bi-heart mr-2"></i>
                                Sukai
                            </button>
                        </form>
                    @else
                        <form action="{{ route('likeDestroy', $creation->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-aurora0 focus:bg-aurora0"
                                tabindex="0">
                                <i class="bi bi-heart-fill mr-2"></i>
                                Disukai
                            </button>
                        </form>
                    @endif
                @endif

                {{-- Download Button --}}
                <a href="{{ asset('img/creations/' . $creation->image_url) }}"
                    class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2" tabindex="0">
                    <i class="bi bi-download mr-2"></i>
                    Unduh
                </a>
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
                        <img src="{{ asset('img/users/' . $creation->user->profile_image) }}" alt=""
                            class="absolute object-cover rounded-full">
                    </a>

                    {{-- Title & Username --}}
                    <div class="flex flex-col space-y-1">
                        {{-- Creation Title --}}
                        <h1 class="font-bold text-xl">
                            {{ $creation->title }}
                        </h1>

                        {{-- Creation Creator Username --}}
                        <div>
                            <span>oleh </span>
                            <a href="{{ route('userShow', $creation->user->username) }}"
                                class="font-medium truncate outline-none transition-colors hover:text-frost3 focus:text-frost3"
                                tabindex="0">
                                {{ $creation->user->username }}
                            </a>
                        </div>

                        @if (Auth::user())
                            @if (Auth::user()->id != $creation->user_id)
                                {{-- Follow Button --}}
                                @if ($isFollowingPoster)
                                    <form action="{{ route('followDestroy', $creation->user_id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="py-1 px-3 border rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-aurora0 focus:bg-aurora0"
                                            tabindex="0">
                                            <i class="bi-person-dash mr-2"></i>Diikuti
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('followStore', $creation->user_id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-frost3 py-1 px-3 rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-frost2 focus:bg-frost2"
                                            tabindex="0">
                                            <i class="bi-person-plus mr-2"></i>Ikuti
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Creation Date Details --}}
                <div class="flex flex-col text-snow2/70 italic">
                    <div>
                        <span>Dipublikasikan: </span>
                        <span class="cursor-help underline underline-offset-2 decoration-dotted"
                            title="{{ $creation->created_at->setTimezone('Asia/Makassar') }}">
                            {{ $creation->created_at->setTimezone('Asia/Makassar')->diffForHumans() }}
                        </span>
                    </div>

                    @if ($creation->created_at != $creation->updated_at)
                        <div>
                            <span>Diperbarui: </span>
                            <span class="cursor-help underline underline-offset-2 decoration-dotted"
                                title="{{ $creation->updated_at->setTimezone('Asia/Makassar') }}">
                                {{ $creation->updated_at->setTimezone('Asia/Makassar')->diffForHumans() }}
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Like and Comment Counter --}}
                <div class="flex space-x-4">
                    <div><i class="bi bi-heart mr-2"></i>{{ $creation->likes->count() }} disukai</div>
                    <div><i class="bi bi-chat-dots mr-2"></i>{{ $creation->allComments->count() }} komentar</div>
                </div>

                {{-- Creation Keywords --}}
                <div class="flex space-x-2">
                    @foreach (explode(';', $creation->keywords) as $keyword)
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
                    {!! nl2br(e($creation->description)) !!}
                </p>

                <hr>

                {{-- Comments --}}
                <div>
                    <h3 class="font-bold mb-6">Komentar ({{ $creation->allComments->count() }})</h3>
                    @if (Auth::user())
                        @include('components.comment-editor')
                    @endif
                    <div class="mb-6"></div>
                    @if ($creation->comments->count() > 0)
                        <div class="flex flex-col space-y-3">
                            @foreach ($creation->comments as $cmt)
                                @include('components.comment', ['comment' => $cmt, 'margin' => false])
                                @if (Auth::user())
                                    @include('components.comment-editor', [
                                        'comment_parent_id' => $cmt->id,
                                    ])
                                @endif
                            @endforeach
                        </div>
                    @else
                        <span class="py-4">Tidak ada komentar...</span>
                    @endif
                </div>
            </div>

            {{-- Other Creations --}}
            <div class="flex flex-col basis-1/4 space-y-6">
                <h3 class="font-bold">Lainnya oleh pengguna ini</h3>
                @if (count($otherByThisUser) > 0)
                    <div class="grid gap-x-3 gap-y-3 grid-cols-2 md:grid-cols-3 lg:grid-cols-2">
                        @foreach ($otherByThisUser as $crt)
                            @include('components.creation-card', [
                                'creation' => $crt,
                                'creationPoster' => 'hidden',
                                'likesAndComments' => 'hidden',
                            ])
                        @endforeach
                    </div>
                @else
                    <p class="text-snow2/70 italic">
                        Pengguna ini tidak memiliki karya lain...
                    </p>
                @endif
            </div>
        </div>

    </div>
    <script src="{{ asset('js/comments.js') }}"></script>
@endsection
