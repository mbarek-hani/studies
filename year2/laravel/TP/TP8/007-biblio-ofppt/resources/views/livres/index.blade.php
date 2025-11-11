@extends('livres.layout')
@section('title', 'Liste des Livres')
@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">Liste des Livres</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($livres as $livre)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">{{ $livre->title }}</h2>
                <p class="text-gray-700 mb-4">Auteur: {{ $livre->auteur }}</p>
                <div class="flex justify-between items-center">
                    <a href="{{ route('livres.show', $livre->id) }}" class="text-blue-600 hover:underline">Voir Détails</a>
                    <form action="{{ route('livres.destroy', $livre->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded cursor-pointer">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
