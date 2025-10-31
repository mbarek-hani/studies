@extends('layouts.app')
@section('titre', 'Liste Utilisateurs')
@section('contenu')
    @include('partials.alert', ['message' => 'Attention : Liste en test !'])
    <h2>Utilisateurs</h2>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user['nom'] }} - {{ $user['age'] }} ans</li>
        @endforeach
    </ul>
    Raw PHP : {!! '<strong>Texte en gras</strong>' !!}<br>
    @isset($users)
        Users est défini.
    @endisset
    @empty($users)
        Pas d'utilisateurs.
    @else
        Il y en a !
    @endempty
@endsection
