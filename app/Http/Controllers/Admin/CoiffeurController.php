<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoiffeurController extends Controller
{
    public function index()
    {
        $coiffeurs = Utilisateur::where('id_role', 2)->get();
        return view('admin.coiffeurs.index', compact('coiffeurs'));
    }

    public function create()
    {
        return view('admin.coiffeurs.create');
    }




    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email|unique:utilisateurs,email',
        'mot_de_passe' => 'required|confirmed|min:6',
        'telephone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|max:2048',
    ]);

    $data = $request->all();
    $data['mot_de_passe'] = Hash::make($request->mot_de_passe);
    $data['id_role'] = 2;

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/profils'), $filename);
        $data['photo'] = $filename;
    }

    Utilisateur::create($data);

    return redirect()->route('admin.coiffeurs.index')->with('success', 'Coiffeur ajouté.');
}


    public function edit($id)
    {
        $coiffeur = Utilisateur::findOrFail($id);
        return view('admin.coiffeurs.edit', compact('coiffeur'));
    }




    public function update(Request $request, $id)
{
    $coiffeur = Utilisateur::findOrFail($id);

    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email|unique:utilisateurs,email,' . $id . ',id_utilisateur',
        'telephone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|max:2048',
    ]);

    $coiffeur->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'telephone' => $request->telephone,
    ]);

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/profils'), $filename);
        $coiffeur->photo = $filename;
        $coiffeur->save();
    }

    return redirect()->route('admin.coiffeurs.index')->with('success', 'Coiffeur mis à jour.');
}

    public function destroy($id)
    {
        $coiffeur = Utilisateur::findOrFail($id);
        $coiffeur->delete();

        return redirect()->route('admin.coiffeurs.index')->with('success', 'Coiffeur supprimé.');
    }
}
?>