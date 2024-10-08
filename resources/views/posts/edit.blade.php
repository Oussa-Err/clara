<x-layout>
    <a href="/dashboard" class="text-link text-sm">&larr;Go back to your dashboard</a>
    <div class="card">
        <h2 class="font-bold mb-4 title">Edit your Post</h2>
        <form action={{ route('posts.update', $post) }} method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" class="input @error('title') ring-red-400 @enderror"
                    value="{{ $post->title }}">
                <p class="error">
                    @error('title')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-400 @enderror">{{ $post->body }}</textarea>
                <p class="error">
                    @error('body')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            @if ($post->image)
                <div class="flex flex-col mb-2">
                    <label>Current cover photo</label>
                    <img class="h-auto w-1/2 self-center rounded-lg"
                        src="{{ asset('storage/' . $post->image) }}" alt="blog image">
                </div>
            @endif
            <div class="mb-4">
                <input type="file" name="image" id="image" value="{{ old('image') }}"
                    class="input @error('image') ring-red-400 @enderror">
                <p class="error">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="primary-btn">Submit</button>
        </form>
    </div>
</x-layout>
