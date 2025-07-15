<?php

namespace App\Http\Controllers;

use App\Models\promotion;
use Illuminate\Http\Request;

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
}
