<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



 


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'mot_de_passe' => Hash::check($request->password, 
                Utilisateur::where('email', $request->email)->first()?->mot_de_passe ?? ''
            ) ? $request->password : null
        ];

        $utilisateur = Utilisateur::where('email', $request->email)->first();
        
        if ($utilisateur && Hash::check($request->password, $utilisateur->mot_de_passe)) {
            Auth::login($utilisateur);
            
            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'password' => 'required|string|min:8|confirmed',
            'id_role' => 'required|in:3',
        ]);

        // Récupérer le rôle client par défaut
        $roleClient = Role::where('libelle', 'client')->first();

        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->password),
            'id_role' => $roleClient->id_role,
            

        ]);

        Auth::login($utilisateur);
         // Redirection personnalisée après l'inscription
  /*  if ($utilisateur->id_role == 2) {
        return redirect()->route('client.dashboard');
    } elseif ($utilisateur->id_role == 3) {
        return redirect()->route('coiffeur.dashboard');
    }
   */
   return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
        //return redirect($this->redirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

  
  protected function redirectPath()
{
    /** @var \App\Models\Utilisateur $user */
    $user = Auth::user(); // ✅ Récupère l'utilisateur connecté

    if ($user->isAdmin()) {
        return '/admin/dashboard';
    } elseif ($user->isCoiffeur()) {
        return '/coiffeur/dashboard';
    } else {
        return '/client/home';
    }
}
/*protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isCoiffeur()) {
        return redirect()->route('coiffeur.dashboard');
    } elseif ($user->isClient()) {
        return redirect()->route('client.dashboard');
    }

    return redirect('/'); // fallback
}
*/
 
 
 
 


     
     
     
    
}
