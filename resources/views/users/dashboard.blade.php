<x-layout>
    <h1 class="title">Welcome&nbsp;{{ auth()->user()->username }}, <span class="text-sm">You have&nbsp;
            {{ $posts->total() }}&nbsp;posts</span>
    </h1>
    <div class="card mb-4">
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-yellow-500" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif
        <h2 class="font-bold mb-4 title">Create new Post</h2>
        <form action={{ route('posts.store') }} method="POST">
            @csrf
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" class="input @error('title') ring-red-400 @enderror"
                    value="{{ old('title') }}">
                <p class="error">
                    @error('title')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-400 @enderror">{{ old('body') }}</textarea>
                <p class="error">
                    @error('body')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="primary-btn">Post blog</button>
        </form>
    </div>
    <h1 class="title">Your latest post</h1>
    <div class="grid grid-cols-2 gap-6 justify-end">
        @foreach ($posts as $post)
            <x-postCard :post="$post">
                <form class="grid justify-end" action={{ route('posts.destroy', $post) }} method="post">
                    @csrf
                    {{-- method spoofing --}}
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md mb-2">Delete</button>
                    <button class="bg-blue-500 text-white px-2 py-1 text-xs rounded-md">edit</button>
                </form>
            </x-postCard>
        @endforeach
    </div>
    <div>{{ $posts->links() }}</div>

</x-layout>
