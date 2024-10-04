<x-layout>
    <h1 class="title">View post</h1>
    <div class="card">
        <h2 class="font-bold text-xl">
            {{ $post->title }}
        </h2>
        <div class="text-xs font-light mb-4">
            <span>Posted {{ $post->created_at->diffForHumans() }} BY</span>
            <a href={{ route('posts.user', $post->user) }}
                class="text-blue-500 font-medium">{{ $post->user->username }}</a>
        </div>
        <div class="text-sm">
            <p>{{ $post->body }}</p>
        </div>
    </div>
</x-layout>
