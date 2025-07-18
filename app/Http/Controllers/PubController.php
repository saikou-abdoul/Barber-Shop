<?php

namespace App\Http\Controllers;

use App\Models\promotion;
use Illuminate\Http\Request;
use Storage;

class PubController extends Controller
{
    
    public function index()
    {
        // On ne récupère que les promotions actives
        $promotions = promotion::where('date_debut', '<=', now())
                               ->where('date_fin', '>=', now())
                               ->with('service')
                               ->get();

        return view('client.pub.index', compact('promotions'));
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'id_service' => 'required|exists:services,id_service',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('promotions', 'public');
    }

    Promotion::create($validated);

    return redirect()->route('promotions.index')->with('success', 'Promotion créée.');
}
public function update(Request $request, $id)
{
    $promotion = Promotion::findOrFail($id);

    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'id_service' => 'required|exists:services,id_service',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $promotion->titre = $request->titre;
    $promotion->description = $request->description;
    $promotion->date_debut = $request->date_debut;
    $promotion->date_fin = $request->date_fin;
    $promotion->id_service = $request->id_service;

    if ($request->hasFile('image')) {
        // Supprimer l’ancienne image si elle existe
        if ($promotion->image && Storage::disk('public')->exists($promotion->image)) {
            Storage::disk('public')->delete($promotion->image);
        }

        // Enregistrer la nouvelle
        $path = $request->file('image')->store('promotions', 'public');
        $promotion->image = $path;
    }

    $promotion->save();

    return redirect()->route('promotions.index')->with('success', 'Promotion mise à jour avec succès.');
}


}
