<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
     public function profil()
    {
        $utilisateur = Auth::user();
        return view('client.profil', compact('utilisateur'));
    }

    public function updateProfil(Request $request)
    {
        $utilisateur = Auth::user();

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $utilisateur->id_utilisateur . ',id_utilisateur',
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:6'
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/profils'), $imageName);
            $utilisateur->photo = $imageName;
        }

        $utilisateur->prenom = $request->prenom;
        $utilisateur->nom = $request->nom;
        $utilisateur->email = $request->email;
        $utilisateur->telephone = $request->telephone;
          // ✅ Hasher et mettre à jour le mot de passe s'il est fourni
        if ($request->filled('password')) {
        $utilisateur->password = $request->password;
        }

        $utilisateur->save();

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
