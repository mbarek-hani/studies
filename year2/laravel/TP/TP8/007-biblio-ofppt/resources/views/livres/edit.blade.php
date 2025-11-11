@extends('livres.layout')
@section('title', 'Modifier le Livre')
@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">Modifier le Livre</h1>
    <form action="{{ route('livres.update', $livre->id) }}" method="POST"
        class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="titre" class="block text-gray-700 font-bold mb-2">Titre:</label>
            <input type="text" name="title" id="title" value="{{ $livre->title }}"
                class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="auteur" class="block text-gray-700 font-bold mb-2">Auteur:</label>
            <input type="text" name="auteur" id="auteur" value="{{ $livre->auteur }}"
                class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="auteur" class="block text-gray-700 font-bold mb-2">Editeur:</label>
            <input type="text" name="editeur" id="editeur" value="{{ $livre->editeur }}"
                class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <!-- Annee -->
        <div class="mb-4">
            <label for="annee" class="block text-gray-700 font-bold mb-2">Année de Publication:</label>
            <input type="number" name="annee" id="annee" value="{{ $livre->annee }}"
                class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <!-- isbn -->
        <div class="mb-4">
            <label for="isbn" class="block text-gray-700 font-bold mb-2">ISBN:</label>
            <input type="text" name="isbn" id="isbn" value="{{ $livre->isbn }}"
                class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounde hover:bg-blue-700">Mettre à Jour le Livre</button>
        </div>
    </form>
@endsection
