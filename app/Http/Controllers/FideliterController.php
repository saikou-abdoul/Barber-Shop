<?php
namespace App\Http\Controllers;

use App\Models\Fideliter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FideliterController extends Controller
{
    // Affiche les points fidélité de l'utilisateur connecté
    public function index()
    {
        
        $fidelite = Fideliter::where('id_utilisateur_client', Auth::id())->first();
        return view('client.fidelite.index', compact('fidelite'));
    }

    // Exemple d'ajout de points (peut être déclenché après un achat)
    public function ajouterPoints(Request $request)
    {
        $pointsAAjouter = $request->input('points', 10); // valeur par défaut : 10

        $fidelite = Fideliter::firstOrCreate(
            ['id_utilisateur_client' => Auth::id()],
            ['points' => 0]
        );

        $fidelite->points += $pointsAAjouter;
        $fidelite->save();

        return redirect()->route('fidelite.index')->with('success', 'Points ajoutés !');
    }
}
