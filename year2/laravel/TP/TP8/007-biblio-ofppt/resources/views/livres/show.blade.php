@extends('livres.layout')
@section('title', 'Détails du Livre')
@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">Détails du Livre</h1>
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <p class="mb-4"><span class="font-bold">Titre:</span> {{ $livre->title }}</p>
        <p class="mb-4"><span class="font-bold">Auteur:</span> {{ $livre->auteur }}</p>
        <p class="mb-4"><span class="font-bold">Editeur:</span> {{ $livre->editeur }}</p>
        <p class="mb-4"><span class="font-bold">Année de Publication:</span> {{ $livre->annee }}</p>
        <p class="mb-4"><span class="font-bold">ISBN:</span> {{ $livre->isbn }}</p>
        <div class="flex justify-between items-center">
            <a href="{{ route('livres.index') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">Retour à la Liste des Livres</a>
            <a href="{{ route('livres.edit', $livre->id) }}" class="bg-green-300 text-black py-2 px-4 rounded">Edit</a>
        </div>
    </div>
@endsection
