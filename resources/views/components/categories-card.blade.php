<div class="flex flex-col space-y-2 ">
    <a href="{{ route('showCategory', $creation->category_id) }}" class="group relative flex aspect-video rounded-lg outline-none"
        tabindex="0">
        <img src="{{ asset('img/creations/' . $creation->image_url) }}" alt="{{ $creation->category->category_name }}"
            class="absolute object-cover w-full h-full rounded-lg">
        <div
            class="absolute flex justify-center items-center w-full h-full px-4 py-2 bg-gradient-to-t from-polar0 to-transparent opacity-0 transition-opacity group-hover:opacity-100 group-focus:opacity-100">
            <span class="font-medium">{{ $creation->category->category_name }}</span>
        </div> 
    </a>
</div>