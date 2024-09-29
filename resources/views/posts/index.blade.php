<x-layout>
    <h1>hello</h1>
    
    @auth
    <h1>logged in</h1>
        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); --}}
    @endauth

    @guest
        <h1>Guest</h1>
    @endguest
</x-layout>
