<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Models\Avis;
use App\Models\Role;
use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', function () {
    $avisRecents = Avis::latest()->with('client')->take(3)->get();
    $moyenne = Avis::count() > 0 ? Avis::avg('note') : 0;

    return view('welcome', compact('avisRecents', 'moyenne'));
});











Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Routes protégées
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/client', [DashboardController::class, 'clientDashboard'])->name('dashboards');
    
    // Routes pour les réservations
   // Route::resource('reservations', ReservationController::class);
   // Route::put('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])
  //      ->name('reservations.update-status');
});
/*Route::get('/reservations/create', [ReservationController::class, 'create'])
    ->name('reservations.create');
//Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::post('/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
   // Route::get('/reservations/create/', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});

 Route::get('/reservations/create/{id_service}', [ReservationController::class, 'create'])->name('reservations.create');
// Routes spécifiques aux rôles
/*Route::middleware(['auth', 'check.role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    // Autres routes admin...
});

Route::middleware(['auth', 'check.role:coiffeur'])->prefix('coiffeur')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'coiffeurDashboard'])->name('coiffeur.dashboard');
    // Autres routes coiffeur...
});

Route::middleware(['auth', 'check.role:client'])->prefix('client')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'clientDashboard'])->name('client.dashboard');
    // Autres routes client...
});
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:coiffeur'])->group(function () {
    Route::get('/coiffeur/dashboard', [DashboardController::class, 'index'])->name('coiffeur.dashboard');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');
});

Route::middleware(['auth', 'role:admin,coiffeur'])->group(function () {
    Route::resource('services', ServiceController::class)->except(['show']);
});
//reservation terminer
Route::middleware('auth')->post('/reservations/{reservation}/done', [ReservationController::class, 'markAsDone'])->name('reservations.done');
//Admin page terminé
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\CoiffeurController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\FideliterController;
use App\Http\Controllers\PubController;
use App\Http\Controllers\UtilisateurController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/services-termines', [AdminReservationController::class, 'servicesTermines'])->name('services.termines');
});
// chemin de disponibilité du coiffeur
Route::get('/disponibilites/{coiffeur}/{date}', [App\Http\Controllers\ReservationController::class, 'getDisponibilites']);

//Annullation de reservation du client
Route::patch('/reservations/{reservation}/annuler', [ReservationController::class, 'annuler'])
    ->middleware('auth')
    ->name('reservations.annuler');
// Chemin creation de disponibilité
Route::middleware(['auth'])->group(function () {
    Route::resource('disponibilites', DisponibiliteController::class)->except(['show', 'edit', 'update']);
});

Route::get('/disponibilites/{coiffeurId}/{date}', [DisponibiliteController::class, 'getDisponibilites']);

Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])
    ->name('reservations.destroy');
// chemin d'enregistremen de reservation
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('/reservations/{reservation}/edit-client', [ReservationController::class, 'editParClient'])->name('reservations.edit.client');
Route::put('/reservations/{reservation}/update-client', [ReservationController::class, 'updateParClient'])->name('reservations.update.client');
    // chemin de supp coiff
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
// chemin de supp client 
Route::delete('/reservations/{reservation}/client', [ReservationController::class, 'destroyClient'])
    ->middleware(['auth'])
    ->name('reservations.destroy.client');

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

// chemin de la page principale
Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/client/home', [ClientController::class, 'home'])->name('client.home');
});

//home
Route::middleware(['auth'])->group(function () {
    Route::get('/client/home', [ClientController::class, 'home'])->name('client.home');
});

//service page client
Route::get('/nos-services', [\App\Http\Controllers\ClientServiceController::class, 'index'])->name('client.services');

// suppression de service
Route::resource('services', ServiceController::class);

// route du profil
Route::middleware('auth')->group(function () {
    Route::get('/client/profil', [UtilisateurController::class, 'profil'])->name('client.profil');
    Route::post('/client/profil', [UtilisateurController::class, 'updateProfil'])->name('client.profil.update');
});

// route temoignage clientel
//Route::post('/temoignage', [TemoignageController::class, 'store'])->name('temoignage.store');

// acces a toutes les reservations
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
});
// gerer coiffeur
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('coiffeurs', CoiffeurController::class)->names('admin.coiffeurs');
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('admin.index');
});




// statistique coiffeur
Route::get('/admin/statistiques', [AdminController::class, 'statistiques'])->name('admin.statistiques');

// avis client

Route::middleware('auth')->group(function () {
    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::get('/avis/{id}/edit', [AvisController::class, 'edit'])->name('avis.edit');
    Route::put('/avis/{id}', [AvisController::class, 'update'])->name('avis.update');
    Route::delete('/avis/{id}', [AvisController::class, 'destroy'])->name('avis.destroy');
});

Route::get('/avis', [AvisController::class, 'index'])->name('avis.index');

// promotion route admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('admin/promotions', PromotionController::class);
});
// pub client de promotions
Route::get('/pub', [PubController::class, 'index'])->name('pub.index');

// route client fidelite

Route::middleware(['auth'])->group(function () {
    Route::get('/fidelite', [FideliterController::class, 'index'])->name('fidelite.index');
    Route::post('/fidelite/ajouter', [FideliterController::class, 'ajouterPoints'])->name('fidelite.ajouter');
});

// route pour le message de poit de fideliter
Route::patch('/reservations/{id}/terminer', [ReservationController::class, 'marquerCommeTerminee'])
    ->name('reservations.terminer');
// route de suppression coiffeur
    Route::delete('/reservations/{reservation}/coiffeur', [ReservationController::class, 'destroyByCoiffeur'])
    ->middleware(['auth'])
    ->name('reservations.destroy.coiffeur');
