<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;

class HomeController extends Controller
{
    

public function index() {
    $avisRecents = Avis::latest()->with('client')->take(3)->get();
    $moyenne = Avis::avg('note');

    return view('welcome', compact('avisRecents', 'moyenne'));
}

}
