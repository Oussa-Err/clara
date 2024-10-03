@props(['post'])
<div class="card ">
    <h2 class="font-bold text-xl">
        {{ $post->title }}
    </h2>
    <div class="text-xs font-light mb-4">
        {{-- using Carbon nesbot for date formating --}}
        <span>Posted {{ $post->created_at->diffForHumans() }} BY</span>
        <a href="#" class="text-blue-500 font-medium">username</a>
    </div>
    <div class="text-sm">
        <p>{{ Str::words($post->body, 15, '...') }}</p>
        {{-- alternatively --}}
        {{-- <p>{{ substr($post->body, 0, 100 )}}...</p> --}}
    </div>
</div>
