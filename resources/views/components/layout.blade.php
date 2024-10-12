<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav>
            <a href={{ route('posts.index') }} class="nav-link">Home</a>
            @auth
                <div class="relative grid place-content-center" x-data="{ open: false }">
                    <button class="round-btn" @click="open = !open">
                        <img src="https://picsum.photos/200" alt="profile-icon">
                    </button>
                    <div x-show='open' @click.outside="open = false"
                        class="top-10 right-0 overflow-hidden shadow-lg font-light absolute rounded-lg bg-white">
                        <p class="text-sm pl-4 pr-8 py-2 mb-1">{{ auth()->user()->username }}</p>
                        <a href="{{ route('dashboard') }}"
                            class="font-semibold block hover:bg-slate-200 pl-4 pr-8 py-2 mb-1 ">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                class="font-semibold block text-left w-full hover:bg-slate-200 pl-4 pr-8 py-2 mb-1">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div class="flex items-center gap-4">
                    <a href={{ route('login') }} class="nav-link">login</a>
                    <a href={{ route('register') }} class="nav-link">register</a>
                </div>
            @endguest
        </nav>
    </header>
    <main class="py-8 px-4 mx-auto">
        {{ $slot }}
    </main>
</body>
<script>
    // loading spinner here with alpine tobeadded
</script>

</html>
