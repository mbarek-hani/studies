@extends('livres.layout')
@section('title', 'Ajouter un Livre')
@section('content')
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">Ajouter un Nouveau Livre</h1>
    <form action="{{ route('livres.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="titre" class="block text-gray-700 font-bold mb-2">Titre:</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="auteur" class="block text-gray-700 font-bold mb-2">Auteur:</label>
            <input type="text" name="auteur" id="auteur" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="auteur" class="block text-gray-700 font-bold mb-2">Editeur:</label>
            <input type="text" name="editeur" id="editeur" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="annee" class="block text-gray-700 font-bold mb-2">Année de Publication:</label>
            <input type="number" name="annee" id="annee" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="isbn" class="block text-gray-700 font-bold mb-2">ISBN:</label>
            <input type="text" name="isbn" id="isbn" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter le Livre</button>
        </div>
    </form>
@endsection
