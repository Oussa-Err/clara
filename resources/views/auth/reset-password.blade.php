<x-layout>
    <h1 class="title text-left">Create new password</h1>
    <div class="max-w-screen-sm mx-auto card">
        <form action={{ route('password.update') }} method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label for="email">email:</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" autocomplete="email"
                    class="input @error('email') ring-red-500 @enderror">
                @error('email')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password">New password:</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    class="input @error('password') ring-red-500 @enderror">
                @error('password')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation">Confirm new password:</label>
                <input type="password" id="password" name="password_confirmation"
                    class="input @error('password') ring-red-500 @enderror">
            </div>

            <button type="submit" class="primary-btn">Register</button>
        </form>
    </div>
</x-layout>
