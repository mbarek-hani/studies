@extends('emails.layout') @section('title', 'Bienvenue sur Eventify')
@section('content')
<div class="header">
    <h1 style="color: #4f46e5">🎉 Bienvenue sur Eventify !</h1>
</div>
<div class="content">
    <p>Bonjour <strong>{{ $name }}</strong>,</p>
    <p>
        Merci de votre inscription sur <strong>Eventify</strong>, la meilleure
        plateforme de gestion d’événements au Maroc.
    </p>
    <p>Votre compte a été créé avec succès. Vous pouvez maintenant :</p>
    <ul>
        <li>Créer vos propres événements</li>
        <li>Participer aux événements de la communauté</li>
        <li>Gérer vos inscriptions</li>
    </ul>
    <div style="text-align: center">
        <a href="{{ url('/') }}" class="button">Accéder à mon espace</a>
    </div>
    <p>Si vous avez des questions, n’hésitez pas à nous contacter.</p>
    <p>
        Cordialement,<br />
        <strong>L’équipe Eventify</strong>
    </p>
</div>
@endsection
