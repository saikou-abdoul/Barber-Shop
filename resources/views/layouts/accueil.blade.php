<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SalOOn')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    
    <!-- Style personnalisé -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background: url('{{ asset('assets/img/hero/h1_hero.png') }}') center center/cover no-repeat;
            height: 100vh;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 3rem;
        }

        .hero-text p {
            font-size: 1.2rem;
            
        }
        .pricing-list ul li {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-weight: 500;
    border-bottom: 1px dashed #ccc;
}

.pricing-img1, .pricing-img2 {
    position: absolute;
    z-index: -1;
    max-width: 200px;
}

.pricing-img1 {
    left: 0;
    bottom: 0;
}

.pricing-img2 {
    right: 0;
    top: 0;
}
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
}


@keyframes zoomInRotate {
    0% {
        opacity: 0;
        transform: scale(0.4) rotate(-45deg);
    }
    100% {
        opacity: 1;
        transform: scale(1) rotate(0);
    }
}

@keyframes fadeSlideIn {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

#logoIcon {
    opacity: 0;
}

#logoText {
    opacity: 0;
}

.animate-icon {
    animation: zoomInRotate 0.8s ease-out forwards;
}

.animate-text {
    animation: fadeSlideIn 1s ease-out 0.2s forwards;
}


/* Preloader plein écran */
#preloader {
    position: fixed;
    width: 100%;
    height: 100vh;
    background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: opacity 0.6s ease-out, visibility 0.6s ease-out;
}

/* Contenu centré */
.preloader-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Spinner animé */
 {
    width: 60px;
    height: 60px;
    border: 6px solid #ccc;
    border-top: 6px solid #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/* Animation rotation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Logo style */
.logo {
    width: 80px;
    height: auto;
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: scale(0.9); }
    100% { opacity: 1; transform: scale(1); }
}
</style>
</head>
<body>

    
<!-- Preloader stylisé -->
<div id="preloader">
    <div class="preloader-content text-center">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center">
        <i class="bi bi-scissors me-2 fs-4" id="logoIcon"></i>
         <span id="logoText" style="font-size: 1.6rem;">Sal<span class="text-dark">OOn</span></span>
        </a>
        <p class="text-dark fw-semibold">Chargement...</p>
    </div>
</div>

    <!-- Navbar -->
    @include('partials.navaccueil')

    <!-- Contenu -->
    <main>
        @yield('content')
    </main>
<a href="{{ route('login') }}" class="btn btn-primary rounded-pill shadow position-fixed bottom-0 end-0 m-4"
   style="z-index: 1050;">
    <i class="bi bi-calendar-check me-2"></i> Réserver
</a>


 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const icon = document.getElementById('logoIcon');
        const text = document.getElementById('logoText');

        if (icon) icon.classList.add('animate-icon');
        if (text) text.classList.add('animate-text');
    });
</script>


<script>
    window.addEventListener("load", function () {
        setTimeout(() => {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            preloader.style.visibility = 'hidden';
        }, 2000); // visible 2 secondes
    });
</script>

</body>
</html>
