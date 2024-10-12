<x-layout>
    <h1 class="title text-left">Register Now</h1>
    <div class="max-w-screen-sm mx-auto card">
        <form action={{ route('register') }} method="POST">
            @csrf

            <div class="mb-4">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" autocomplete="name"
                    class="input @error('username') ring-red-500 @enderror ">
                @error('username')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

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
                <label for="password">password:</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    class="input @error('password') ring-red-500 @enderror">
                @error('password')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation">Confirm password:</label>
                <input type="password" id="password" name="password_confirmation"
                    class="input @error('password') ring-red-500 @enderror">
            </div>

            <div>

                <div class="mb-4 inline-flex gap-2 h-fit">
                    <input type="checkbox" name="subscribe" id='subscribe'
                        class="focus:outline-none focus-visible:outline-none w-fit self-center" />
                    <label for="subscribe" class="inline-flex">Subscribe to our newsletter</label>
                </div>
                @error('subscribe')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit" class="primary-btn">Register</button>
        </form>
    </div>
</x-layout>
