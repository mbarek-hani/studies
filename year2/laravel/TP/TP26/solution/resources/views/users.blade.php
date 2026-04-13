<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Choisir un utilisateur pour commencer une conversation avec lui
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($users as $user)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="{{ route("chat.index", [$user->id]) }}">
                            <p>{{ $user->name }}</p>
                        </a>
                    </div>
                @endforeach
        </div>
    </div>
</x-app-layout>
