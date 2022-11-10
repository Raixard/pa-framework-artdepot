{{-- Comment Editor --}}
<div class="flex space-x-3 {{ isset($comment_parent_id) ? 'ml-8 hidden reply-form' : '' }}"
    id="{{ isset($comment_parent_id) ? 'reply-form-' . $comment_parent_id : '' }}">
    {{-- Commenter Profile Image --}}
    <img src="{{ asset('img/users/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->username }}"
        class="w-12 h-12 aspect-square rounded-full">

    {{-- Text Editor --}}
    <form action="{{ route('commentStore', $creation->id) }}" method="post"
        class="flex flex-col items-end w-full px-3 pt-1 pb-3 space-y-2 rounded-lg bg-polar1">
        @csrf
        <input type="hidden" name="creation_id" value="{{ $creation->id }}">
        <input type="hidden" name="parent_id" value="{{ $comment_parent_id ?? '' }}">
        <textarea name="content" rows="4" placeholder="Tulis komentar..."
            class="opacity-70 resize-none p-3 rounded-lg w-full outline-none text-polar0 bg-snow transition-opacity hover:opacity-100 focus:opacity-100"></textarea>
        <button type="submit" tabindex="0"
            class="px-3 py-1 bg-frost3 rounded-lg transition-colors hover:bg-frost2 focus:bg-frost2">
            Kirim
        </button>
    </form>
</div>
