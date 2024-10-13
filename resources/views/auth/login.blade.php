<x-layout>
    <h1 class="title text-left">Login</h1>
    <div class="max-w-screen-sm mx-auto card">
        <form action={{ route('login') }} method="POST">
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

            <div class="mb-4 inline-flex gap-2 h-fit">
                <input type="checkbox" name="remember" id='remember'
                    class="focus:outline-none focus-visible:outline-none w-fit self-center" />
                <label for="remember" class="inline-flex">Remember me</label>
            </div>
            @error('failed')
                <p class="error">
                    {{ $message }}
                </p>
            @enderror

            <a href="{{ route('password.request') }}" class="text-link">reset password</a>
            <button type="submit" class="primary-btn">Login</button>
        </form>
    </div>

</x-layout>
