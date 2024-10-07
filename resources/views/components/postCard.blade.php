@props(['post', 'full' => false])
<div class="card">
    <h2 class="font-bold text-xl">
        {{ $post->title }}
    </h2>
    <div>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="blog image">
        @else
            <img src="{{ asset('storage/blog_images/default.png') }}" alt="blog image">
        @endif
    </div>
    <div class="text-xs font-light mb-4">
        {{-- using Carbon nesbot for date formating --}}
        <span>Posted {{ $post->created_at->diffForHumans() }} BY</span>
        {{-- route model biding --}}
        <a href={{ route('posts.user', $post->user) }} class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>
    @if ($full)
        <div class="text-sm">
            <span>{{ $post->body }}</span>
        </div>
    @else
        <div class="text-sm">
            <span>{{ Str::words($post->body, 15, '...') }}</span>
            <a href={{ route('posts.show', $post) }} class="text-link">Read more &rarr;</a>
            {{-- alternatively --}}
            {{-- <p>{{ substr($post->body, 0, 100 )}}...</p> --}}
        </div>
    @endif

    <div>
        {{ $slot }}
    </div>
</div>
