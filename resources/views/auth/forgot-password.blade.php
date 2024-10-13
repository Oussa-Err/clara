<x-layout>
    <h1 class="title">Reset your password</h1>
    <div class="max-w-screen-sm mx-auto card">

        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" bg="bg-green-500" />
        @elseif (session('failed'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email">email:</label>
                <input type="text" id="email" name="email"
                    class="input
            @error('email') ring-red-500 @enderror
            "
                    value={{ old('email') }}>
                @error('email')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <button class="primary-btn">Submit</button>
        </form>
    </div>
</x-layout>
