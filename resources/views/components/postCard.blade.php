@props(['post', 'full' => false])
<div class="max-w-sm rounded overflow-hidden shadow-lg">
    @if ($post->image)
        <img class="w-full" src="{{ asset('storage/' . $post->image) }}" alt="blog image">
    @else
        <img class="w-full" src="{{ asset('storage/blog_images/default.png') }}" alt="blog image">
    @endif
    <div class="px-6 py-4">
        <h2 class="font-bold text-xl">
            {{ $post->title }}
        </h2>
        <div class="text-xs font-light mb-4">
            {{-- using Carbon nesbot for date formating --}}
            <span>Posted {{ $post->created_at->diffForHumans() }} By</span>
            {{-- route model biding --}}
            <a href={{ route('posts.user', $post->user) }}
                class="text-blue-500 font-medium">{{ $post->user->username }}</a>
        </div>
        @if ($full)
            <span class="text-gray-700 text-base">
                {{ $post->body }}
            </span>
        @else
            <div class="text-sm">
                <span>{{ Str::words($post->body, 15, '...') }}</span>
                <a href={{ route('posts.show', $post) }} class="text-link">Read more &rarr;</a>
                {{-- alternatively --}}
                {{-- <p>{{ substr($post->body, 0, 100 )}}...</p> --}}
            </div>
        @endif
        {{-- tags to be added in the futur --}}
        {{-- <div class="px-6 pt-4 pb-2">
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
            </div> --}}
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
