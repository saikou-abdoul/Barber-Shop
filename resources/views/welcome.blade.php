@extends('layouts.accueil')

@section('title', 'Accueil')

@section('content')
<div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1 class="hero-title">Bienvenue chez SalOOn</h1>
        <p class="hero-subtitle">Un style unique pour une beauté sublime</p>
        <a href="{{ route('login') }}" class="btn btn-warning mt-3">Prendre un rendez-vous</a>
    </div>
</div>


<!-- À propos Section -->
<section id="a-propos" class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('/assets/img/gallery/about.png') }}" class="img-fluid rounded shadow" alt="À propos de nous">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">À propos de SalOOn</h2>
                <p class="text-muted" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    Depuis notre création en 2010, SalOOn est devenu un salon incontournable à Dakar.
                    Avec une équipe de professionnels passionnés, nous mettons en valeur la beauté de chacun,
                    dans une ambiance chaleureuse et moderne. Notre objectif est d’offrir à chaque client une
                    expérience unique et personnalisée.
                </p>
                <p class="text-muted" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    Que ce soit pour une coupe, une coloration, ou un soin capillaire, nous utilisons des produits
                    de qualité et restons à la pointe des dernières tendances pour répondre à tous vos besoins.
                </p>
                 <img src="assets/img/gallery/signature.png" alt="">        
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-light" id="services">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Nos Services</h2>
        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <div class="card-body text-center">
                        <i class="bi bi-scissors fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-semibold">Coupe & Stylisme</h5>
                        <p class="card-text text-muted">Des coupes modernes pour femmes et hommes, selon vos envies.</p>
                    </div>
                </div>
            </div>
            <!-- Service 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <div class="card-body text-center">
                        <i class="bi bi-brush fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-semibold">Coloration</h5>
                        <p class="card-text text-muted">Changez de style avec nos colorations professionnelles durables.</p>
                    </div>
                </div>
            </div>
            <!-- Service 3 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <div class="card-body text-center">
                        <i class="bi bi-droplet-half fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-semibold">Soins capillaires</h5>
                        <p class="card-text text-muted">Des soins profonds pour nourrir, réparer et sublimer vos cheveux.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre équipe -->
<section id="equipe" class="team-area py-5 bg-light">
    <div class="container">
        <!-- Titre -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-11 text-center">
                <div class="section-tittle mb-5">
                    <h2 class="fw-bold">Notre équipe</h2>
                    <h2 class="fw-bold">Des experts passionnés à votre service</h2>
                </div>
            </div>
        </div>

        <!-- Membres -->
        <div class="row g-4">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm text-center h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 15px solid #0d6efd;">
                    <img src="{{ asset('assets/img/gallery/bla.png') }}" class="card-img-top img-fluid" alt="Membre 1">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Josué</h5>
                        <p class="text-muted mb-0">Spécialiste coupe femme</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm text-center h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <img src="{{ asset('assets/img/gallery/bla2.png') }}" class="card-img-top img-fluid" alt="Membre 2">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Goudouss</h5>
                        <p class="text-muted mb-0">PDG</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm text-center h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <img src="{{ asset('assets/img/gallery/bla7.png') }}" class="card-img-top img-fluid" alt="Membre 3">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Elone </h5>
                        <p class="text-muted mb-0">Barbier & soins homme</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm text-center h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                    <img src="{{ asset('assets/img/gallery/bla1.png') }}" class="card-img-top img-fluid" alt="Membre 4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Justin</h5>
                        <p class="text-muted mb-0">Designiére</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Tarifs -->
<section class="py-5 position-relative" style="background-color: #f9f9f9; background: url('{{ asset('assets/img/gallery/about-shape.png') }}') center center / cover no-repeat;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Colonne Texte + Tarifs -->
            <div class="col-lg-7">
                <h2 class="fw-bold mb-4 text-center text-lg-start" id="tarif">Nos meilleurs tarifs</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coiffage</span><span class="text-primary fw-bold">CFA 3 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coiffage + Coloration-noir </span><span class="text-primary fw-bold">CFA 7 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coiffage + Teinture</span><span class="text-primary fw-bold">CFA 12 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Ondulation semi-permanente</span><span class="text-primary fw-bold">CFA 10 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coupe + Coiffage</span><span class="text-primary fw-bold">CFA 7 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coupe + Coiffage + Coloration</span><span class="text-primary fw-bold">CFA 15 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coupe + Coiffage + Teinture</span><span class="text-primary fw-bold">CFA 15 000</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coupe simple</span><span class="text-primary fw-bold">CFA 3 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Rasage</span><span class="text-primary fw-bold">CFA 5 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Taille de barbe</span><span class="text-primary fw-bold">CFA 2 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coupe + barbe</span><span class="text-primary fw-bold">CFA 4 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Coupe + rasage</span><span class="text-primary fw-bold">CFA 5 000</span>
                            </li>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>Nettoyage visage</span><span class="text-primary fw-bold">CFA 5 000</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Colonne Image -->
            <div class="col-lg-5 mt-5 mt-lg-0 text-center">
                <img src="{{ asset('images/i7.jpeg') }}" alt="Tarifs illustration" class="img-fluid rounded shadow" style="max-height: 450px;">
            </div>
        </div>
    </div>
</section>
{{-- 
<section class="py-5 bg-dark text-white" id="temoignages">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold">Ce que disent nos clients</h2>
            </div>
        </div>

        <div class="row g-4">
            @foreach($temoignages->take(4) as $temoin)
            <div class="col-md-6">
                <div class="bg-transparent p-4 border-bottom border-light h-100">
                    <div class="d-flex align-items-start mb-3">
                        <img src="{{ asset('assets/img/icons/quote.png') }}" alt="Quote" style="width: 40px;" class="me-3">
                        <p class="text-white fs-6 fst-italic">{{ $temoin->message }}</p>
                    </div>
                    <hr class="border-light">
                    <h6 class="text-warning text-uppercase mb-0">{{ strtoupper($temoin->nom) }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
--}}

<!-- Galerie du salon (modernisée) -->
<section class="gallery-area py-5 bg-light">
    <div class="container" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
        <!-- Titre de section -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10 text-center">
                <h2 class="fw-bold mb-4" id="portfolio">Quelques images de notre salon</h2>
                <p class="text-muted">Découvrez l’ambiance chaleureuse et le style unique de notre espace</p>
            </div>
        </div>

        <!-- Grille d’images -->
        <div class="row g-4 mt-4">
            @foreach ([
                'gallery1.png', 
                'gallery2.png', 
                'gallery3.png', 
                'image.png'
            ] as $index => $img)
                <div class="col-lg-{{ $index % 2 == 0 ? 4 : 8 }} col-md-6 col-sm-12">
                    <div class="gallery-item position-relative overflow-hidden rounded-4 shadow-sm">
                        <img src="{{ asset('assets/img/gallery/' . $img) }}" alt="Galerie {{ $index + 1 }}" class="img-fluid w-100 h-100 object-fit-cover gallery-img-effect">
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Styles personnalisés -->
<style>
    .gallery-img-effect {
        transition: transform 0.4s ease;
    }

    .gallery-item:hover .gallery-img-effect {
        transform: scale(1.05);
    }

    .gallery-item {
        height: 300px;
    }

    @media (max-width: 768px) {
        .gallery-item {
            height: 220px;
        }
    }
</style>


<section class="bg-white py-5">
    <div class="container" >
        <h3 class="mb-4 text-center">❤️ Ce que disent nos clients</h3>
     {{--    @if (isset($moyenne))
        <p class="text-center text-muted">Note moyenne : <strong>{{ number_format($moyenne, 1) }}/5</strong></p>
        @endif--}} 
        <div class="row">
            @foreach ($avisRecents as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); border-left: 8px solid #0d6efd;">
                        <div class="card-body">
                              <!-- PHOTO DE PROFIL -->
                              
                             <img src="{{ $item->client && $item->client->photo 
                              ? asset('images/profils/' . $item->client->photo) 
                              : asset('images/i9.png') }}" 
                              alt="Photo de profil"
                              class="rounded-circle shadow mb-3"
                              width="80" height="80" style="object-fit: cover; overflow: hidden;  border-radius: 12px;  object-fit: cover;">
                            
                            <h5 class="text-warning mb-2">
                                {{ str_repeat('★', $item->note) }}
                                <small class="text-muted">({{ $item->note }}/5)</small>
                            </h5>
                            <p>{{ $item->commentaire }}</p>
                            <small class="text-muted">— {{ $item->client->prenom ?? 'Client' }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



{{--  

<!-- Galerie du salon -->
<section class="gallery-area py-5 bg-white">
    <div class="container">
        <!-- Titre de section -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10">
                <div class="section-tittle text-center mb-5">
                    <h2 class="fw-bold mb-4" id="portfolio">Quelques images de notre salon</h2>
                </div>
            </div>
        </div>

        <!-- Grille d’images -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="box snake">
                    <div class="gallery-img rounded shadow" style="background-image: url('{{ asset('assets/img/gallery/gallery1.png') }}'); background-size: cover; background-position: center; height: 250px;">
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6 col-sm-6">
                <div class="box snake">
                    <div class="gallery-img rounded shadow" style="background-image: url('{{ asset('assets/img/gallery/gallery2.png') }}'); background-size: cover; background-position: center; height: 250px;">
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6 col-sm-6">
                <div class="box snake">
                    <div class="gallery-img rounded shadow" style="background-image: url('{{ asset('assets/img/gallery/gallery3.png') }}'); background-size: cover; background-position: center; height: 250px;">
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="box snake">
                    <div class="gallery-img rounded shadow" style="background-image: url('{{ asset('assets/img/gallery/gallery4.png') }}'); background-size: cover; background-position: center; height: 250px;">
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
--}}
<footer class="bg-dark text-white pt-5 pb-4" id="contact">
    <div class="container text-md-start">
        <div class="row">
            <!-- À propos -->
              <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
               <i class="bi bi-scissors me-2 fs-4"></i>
                <span style="font-size: 1.6rem;">Sal<span class="text-white">OOn</span></span>
              </a>
            <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
                <p>Salon de coiffure moderne à votre service pour révéler votre style. Une équipe passionnée et professionnelle à Dakar.</p>
            </div>
            <!-- Liens utiles -->
            <div class="col-md-2 col-lg-2 col-xl-2 mb-4">
                <h6 class="text-uppercase fw-semibold mb-3">Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Accueil</a></li>
                    <li><a href="#a-propos" class="text-white text-decoration-none">À propos</a></li>
                    <li><a href="#services" class="text-white text-decoration-none">Services</a></li>
                    <li><a href="#equipe" class="text-white text-decoration-none">Equipe</a></li>
                    <li><a href="#tarif" class="text-white text-decoration-none">Tarift</a></li>
                    <li><a href="#portfolio" class="text-white text-decoration-none">Portfolio</a></li>
                    <li><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>
            <!-- Horaires -->
            <div class="col-md-3 col-lg-3 col-xl-3 mb-4">
                <h6 class="text-uppercase fw-semibold mb-3">Horaires</h6>
                <p>Lundi - Dimanche : 9h00 - 22h00</p>
                <p>Vendredi : 15h00 - 22h00</p>
            </div>

            <!-- Contact et réseaux -->
            <div class="col-md-4 col-lg-3 col-xl-3 mb-md-0 mb-4">
                <h6 class="text-uppercase fw-semibold mb-3">Contact</h6>
                <p><i class="bi bi-geo-alt me-2"></i> Plateau, Dakar</p>
                <p><i class="bi bi-telephone me-2"></i> +221 77 123 45 67</p>
                <p><i class="bi bi-envelope me-2"></i> contact@saloon.sn</p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-whatsapp fs-5"></i></a>
                </div>
            </div>
        </div>

        <!-- Ligne du bas -->
        <hr class="mb-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2025 SalOOn - Tous droits réservés</p>
        </div>
    </div>
</footer>




@endsection
