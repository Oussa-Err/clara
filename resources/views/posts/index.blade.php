<x-layout>
    @auth
        <h1 class="title">logged in</h1>
        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); --}}
    @endauth

    @guest
        <h1 class='title'>Guest</h1>
    @endguest
</x-layout>
