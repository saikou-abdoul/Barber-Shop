<div id="preloader">
    <div class="preloader-content text-center">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center">
            <i class="bi bi-scissors me-2 fs-4" id="logoIcon"></i>
            <span id="logoText" style="font-size: 1.6rem;">Sal<span class="text-dark">OOn</span></span>
        </a>
        <p class="text-dark fw-semibold">Chargement...</p>
    </div>
</div>

<style>
    #preloader {
        position: fixed;
        inset: 0;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: all 0.6s ease-in-out;
    }

    .preloader-content {
        text-align: center;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: scale(0.95); }
        100% { opacity: 1; transform: scale(1); }
    }

    #logoIcon {
        animation: spin 1.5s infinite linear;
    }

    @keyframes spin {
        0% { transform: rotate(0); }
        100% { transform: rotate(360deg); }
    }
</style>
