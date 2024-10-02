<x-layout>
    <h1 class="title">Hello {{ auth()->user()->username }}</h1>
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create new Post</h2>
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
</x-layout>
