<x-layout>
    <h1 class="class">Register a new account</h1>
    <div class="max-w-screen-sm mx-auto card">
        <form action={{ route('register') }} method="POST">
            @csrf

            <div class="mb-4">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"
                    class="input
                @error('username') ring-red-500 @enderror
                "
                    value={{ old('username') }}>
                @error('username')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

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

            <div class="mb-4">
                <label for="password">password:</label>
                <input type="password" id="password" name="password"
                    class="input
                @error('password') ring-red-500 @enderror
                "
                    value={{ old('password') }}>
                @error('password')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation">Confirm password:</label>
                <input type="password" id="password" name="password_confirmation"
                    class="input
                @error('password') ring-red-500 @enderror
                ">
            </div>

            <button type="submit" class="primary-btn">Register</button>
        </form>
    </div>
</x-layout>
