@extends('layouts.app')

@section('title', 'Inscription')

{{-- ✅ Ajoute ici le style de fond personnalisé --}}
@section('custom-style')
    <style>
        body {
            background-image: url('{{ asset('images/img_3.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            position: relative;
        }
         /* Ajout d'un filtre sombre par-dessus le fond */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* assombrit l’im
        z-index: -1; /* reste derrière le contenu */
    }

        /* Facultatif : ajouter un fond blanc semi-transparent au formulaire pour le rendre lisible */
        .card {
            background-color: rgba(255, 255, 255, 0.6);
        }
    </style>
@endsection

@section('content')
<!-- Ton code du formulaire d'inscription reste identique ici -->
