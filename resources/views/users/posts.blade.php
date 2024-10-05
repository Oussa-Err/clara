<x-layout>
    <h1 class="title">{{ $user->username }}'s Posts &#x275B;{{ $posts->total() }}&#x275C;</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>
    <div>{{ $posts->links() }}</div>
</x-layout>