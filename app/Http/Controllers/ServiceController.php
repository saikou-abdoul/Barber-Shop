<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('nom_service')->paginate(10);
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }
public function store(Request $request)
{
    $request->validate([
        'nom_service' => 'required|string|max:255',
        'description' => 'nullable|string',
        'prix' => 'required|numeric|min:0',
        'duree_minutes' => 'required|integer|min:1',
        'actif' => 'boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);


    $data = $request->except('image'); // On prend tout sauf l'image pour le moment

    // Gestion de l’image si elle est envoyée
    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images/services'), $imageName);
        $data['image'] = $imageName;
    }

    Service::create($data);

    return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
}

 /*   public function store(Request $request)
    {
        $request->validate([
            'nom_service' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'duree_minutes' => 'required|integer|min:1',
            'actif' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }
*/
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }
/*
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nom_service' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'duree_minutes' => 'required|integer|min:1',
            'actif' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service mis à jour.');
    }
*/



public function destroy(Service $service)
{
    if ($service->reservations()->exists()) {
        return redirect()->route('services.index')
            ->with('error', 'Impossible de supprimer ce service car des réservations y sont associées.');
    }

    // Supprimer l’image si elle existe
    if ($service->image && file_exists(public_path('images/services/' . $service->image))) {
        unlink(public_path('images/services/' . $service->image));
    }

    $service->delete();

    return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
}

 public function home()
{
    //$services = Service::actif()->get();  // récupère tous les services actifs
    $services = Service::all();   
    return view('client.home', compact('services'));
}

 
}
?>