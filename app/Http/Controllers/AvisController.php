<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Affiche les avis de l'utilisateur connecté.
     */
    public function index()
    {
        $userId = Auth::id();

        $avis = Avis::with('client')
            ->where('id_utilisateur_client', $userId)
            ->latest()
            ->paginate(6);

        $moyenne = Avis::where('id_utilisateur_client', $userId)->avg('note');

        return view('client.avis.index', compact('avis', 'moyenne'));
    }

    /**
     * Enregistre un nouvel avis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        // Vérifie si l'utilisateur a déjà laissé un avis
        if (Avis::where('id_utilisateur_client', $userId)->exists()) {
            return back()->with('error', 'Vous avez déjà laissé un avis.');
        }

        Avis::create([
            'id_utilisateur_client' => $userId,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Merci pour votre avis !');
    }

    /**
     * Affiche le formulaire d'édition pour un avis.
     */
    public function edit($id)
    {
        $avis = Avis::where('id_avis', $id)
                    ->where('id_utilisateur_client', Auth::id())
                    ->firstOrFail();

        return view('client.avis.edit', compact('avis'));
    }

    /**
     * Met à jour un avis existant.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $avis = Avis::where('id_avis', $id)
                    ->where('id_utilisateur_client', Auth::id())
                    ->firstOrFail();

        $avis->update([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('avis.index')->with('success', 'Votre avis a été mis à jour.');
    }

    /**
     * Supprime un avis existant.
     */
    public function destroy($id)
    {
        $avis = Avis::where('id_avis', $id)
                    ->where('id_utilisateur_client', Auth::id())
                    ->firstOrFail();

        $avis->delete();

        return redirect()->route('avis.index')->with('success', 'Votre avis a été supprimé.');
    }
}

/*
    public function index()
    {
        $user= auth()->id();
        $avis = Avis::with('client')->latest()->paginate(6);
        $moyenne = Avis::avg('note');

        return view('client.avis.index', compact('avis','moyenne'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        if (Avis::where('id_utilisateur_client', Auth::id())->exists()) {
    return back()->with('error', 'Vous avez déjà laissé un avis.');
        }

        Avis::create([
            'id_utilisateur_client' => Auth::id(),
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Merci pour votre avis !');
    }

    public function edit($id)
{
    $avis = Avis::where('id_avis', $id)
                ->where('id_utilisateur_client', Auth::id())
                ->firstOrFail();

    return view('client.avis.edit', compact('avis'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'note' => 'required|integer|min:1|max:5',
        'commentaire' => 'nullable|string|max:1000',
    ]);

    $avis = Avis::where('id_avis', $id)
                ->where('id_utilisateur_client', Auth::id())
                ->firstOrFail();

    $avis->update([
        'note' => $request->note,
        'commentaire' => $request->commentaire,
    ]);

    return redirect()->route('avis.index')->with('success', 'Votre avis a été mis à jour.');
}

public function destroy($id)
{
    $avis = Avis::where('id_avis', $id)
                ->where('id_utilisateur_client', Auth::id())
                ->firstOrFail();

    $avis->delete();

    return redirect()->route('avis.index')->with('success', 'Votre avis a été supprimé.');
}





}
*/