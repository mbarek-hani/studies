@extends('layouts.admin')
@section('sidebar')
    <x-admin-side-bar>
        <x-slot name="links">
            <li><a href="/admin/products" style="color:white;">Produits</a></li>
            <li><a href="/admin/orders" style="color:white;">Commandes</a></li>
        </x-slot>
        <x-slot name="footer">
            <small>© 2025 E-Shop</small>
        </x-slot>
    </x-admin-side-bar>
@endsection
@section('title', 'Tableau de Bord')
@section('content')
    <x-alert type="success">
    Bienvenue dans le panneau d'administration !
    </x-alert>
    <h1>Produits en vedette</h1>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        <x-product-card name="Laptop Pro" price="12000" image="
        https://imageplaceholder.net/150">
            <x-button type="primary" href="/product/1">Voir</x-button>
        </x-product-card>
        <x-product-card name="Smartphone X" price="8500">
            <x-button type="danger">Supprimer</x-button>
        </x-product-card>
        <x-product-card name="Casque Audio" price="1200">
            <x-button disabled="true">Indisponible</x-button>
        </x-product-card>
    </div>
@endsection
