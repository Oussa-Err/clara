<x-layout>
    {{-- <h1>verified you can now start using our app <a href="route('dashboard')" class="text-link">here</a></h1> --}}

    <h1 class="mb-4">
        Please verify your email <a href={{ route('verification.notice') }} class="text-link">here</a>
    </h1>
    <p>didn't get the email</p>
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        
        <button class="primary-btn">Send again</button>
    </form>
</x-layout>
