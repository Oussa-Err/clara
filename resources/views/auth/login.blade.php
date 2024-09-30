<x-layout>
    <div class="max-w-screen-sm mx-auto card">
        <h1 class="title">Login</h1>
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

            <div class="mb-4 inline-flex gap-2">
                <input type="checkbox" name="remember" id='remember' class=" w-fit"></input>
                <label for="remember">Remember me</label>
            </div>

            @error('failed')
                <p class="error">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit" class="primary-btn">Login</button>
        </form>
    </div>

</x-layout>
