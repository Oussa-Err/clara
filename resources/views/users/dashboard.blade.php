<x-layout>
    <h1 class="title">Welcome&nbsp;{{ auth()->user()->username }}, <span class="text-sm">You have&nbsp;
            {{ $posts->total() }}&nbsp;posts</span>
    </h1>
    <div class="card mb-4">
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-green-500" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @elseif (session('update'))
            <x-flashMsg msg="{{ session('update') }}" bg="bg-yellow-500" />
        @endif
        <h2 class="font-bold mb-4 title">Create new Post</h2>
        <form action={{ route('posts.store') }} method="POST" enctype="multipart/form-data">
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
            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image" value="{{ old('image') }}"
                    class="input @error('image') ring-red-400 @enderror">
                <p class="error">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="primary-btn">Post blog</button>
        </form>
    </div>
    <h1 class="title">Your latest post</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 justify-end">
        @foreach ($posts as $post)
            <x-postCard :post="$post">
                <div class="flex justify-end gap-2 mt-2">
                    <a href="{{ route('posts.edit', $post) }}"
                        class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>
                    <form action={{ route('posts.destroy', $post) }} method="post">
                        @csrf
                        {{-- method spoofing --}}
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 text-xs w-full rounded-md">Delete</button>
                    </form>
                </div>
            </x-postCard>
        @endforeach
    </div>
    <div>{{ $posts->links() }}</div>

</x-layout>
