<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Service;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('service')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.promotions.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'id_service' => 'required|exists:services,id_service',
        ]);

        Promotion::create($request->all());

        return redirect()->route('promotions.index')->with('success', 'Promotion ajoutée avec succès.');
    }

    public function edit(Promotion $promotion)
    {
        $services = Service::all();
        return view('admin.promotions.edit', compact('promotion', 'services'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'id_service' => 'required|exists:services,id_service',
        ]);

        $promotion->update($request->all());

        return redirect()->route('promotions.index')->with('success', 'Promotion modifiée avec succès.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promotion supprimée.');
    }
}
