<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientServiceController extends Controller
{
    public function index()
{
    $services = \App\Models\Service::where('actif', true)->get();
    return view('client.services', compact('services'));
}

}
