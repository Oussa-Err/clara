@props(['post'])
<div class="card">
    <h2 class="font-bold text-xl">
        {{ $post->title }}
    </h2>
    <div class="text-xs font-light mb-4">
        {{-- using Carbon nesbot for date formating --}}
        <span>Posted {{ $post->created_at->diffForHumans() }} BY</span>
        {{-- route model biding --}}
        <a href={{ route('posts.user', $post->user) }} class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>
    <div class="text-sm">
        <span>{{ Str::words($post->body, 15, '...') }}</span>
        <a href={{ route('post', $post) }} class="text-link">Read more &rarr;</a>
        {{-- alternatively --}}
        {{-- <p>{{ substr($post->body, 0, 100 )}}...</p> --}}
    </div>
</div>
