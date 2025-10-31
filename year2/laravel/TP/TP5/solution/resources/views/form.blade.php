@extends('layouts.app')
@section('titre', 'Formulaire')
@section('contenu')
    <form action="/submit" method="POST">
        @csrf
        <label>Nom :</label>
        <input type="text" name="nom" value="{{ old('nom') }}">
        <button>Envoyer</button>
    </form>
@endsection
