{{-- Comment --}}
<div class="flex flex-col space-y-2">
    {{-- If the comment is not deleted --}}
    @if ($comment->user_id != null)
        {{-- Comment Position --}}
        <div class="flex space-x-3 {{ $margin ? 'ml-8' : '' }}">
            {{-- Commenter Profile Image --}}
            <a href="{{ route('userShow', $comment->user->username) }}"
                class="relative flex items-center w-12 h-12 aspect-square rounded-full">
                <img src="{{ asset('img/users/' . $comment->user->profile_image) ? asset('img/users/' . $comment->user->profile_image) : asset('img/users/user-default.jpg') }}"
                    alt="{{ $comment->user->username }}" class="absolute object-cover rounded-full">
            </a>

            {{-- Comment Content --}}
            <div class="flex flex-col w-full bg-polar1 pt-3 pb-6 px-6 rounded-lg">
                {{-- Commenter Username and Comment Date --}}
                <div class="flex flex-col mb-2 sm:flex-row sm:justify-between sm:items-center">
                    <a href="{{ route('userShow', $comment->user->username) }}"
                        class="font-bold truncate transition-colors hover:text-frost3 focus:text-frost3" tabindex="0">
                        {{ $comment->user->username }}
                    </a>
                    <p class="cursor-help text-snow2/70 text-sm underline underline-offset-2 decoration-dotted"
                        title="{{ $comment->created_at->setTimezone('Asia/Makassar') }}">
                        {{ $comment->created_at->setTimezone('Asia/Makassar')->diffForHumans() }}
                    </p>
                </div>

                {{-- Comment Content --}}
                <p>
                    {!! nl2br(e($comment->content)) !!}
                </p>
            </div>
        </div>

        {{-- Comment Actions --}}
        @if (Auth::user())
            <div class="flex justify-end space-x-3">
                {{-- Delete Button --}}
                @if ($comment->user_id == Auth::user()->id ||
                    $creation->user_id == Auth::user()->id ||
                    Auth::user()->role == 'admin')
                    <form action="{{ route('commentDestroy', [$creation->id, $comment->id]) }}" method="POST"
                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus komentar ini?')">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="px-3 py-1 rounded-lg text-aurora0 transition-colors hover:bg-aurora0/70 hover:text-snow2 focus:bg-aurora0/70 focus:text-snow2"
                            tabindex="0">Hapus</button>
                    </form>
                @endif

                {{-- Reply Button --}}
                <button onclick="{{ 'toggleReplyForm(' . ($comment->parent_id ?? $comment->id) . ')' }}"
                    class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2"
                    tabindex="0">Balas</button>
            </div>
        @endif
        {{-- If the comment is deleted --}}
    @else
        {{-- Deleted comment sign --}}
        <div class="flex space-x-3 {{ $margin ? 'ml-8' : '' }}">
            <div class="{{ $margin ? 'w-12 h-12' : '' }}"></div>
            <div class="w-full pt-3 pb-6 px-6 mb-3 rounded-lg bg-polar1 text-snow2/70 italic">
                @if ($comment->deleted_by == 'poster')
                    Komentar ini telah dihapus oleh pemilik karya...
                @elseif($comment->deleted_by == 'admin')
                    Komentar ini telah dihapus oleh admin...
                @else
                    Komentar ini telah dihapus oleh pengirim komentar...
                @endif

            </div>
        </div>
    @endif
</div>

@if ($comment->replies->count() > 0)
    @foreach ($comment->replies as $reply)
        @include('components.comment', ['comment' => $reply, 'margin' => true])
    @endforeach
@endif
