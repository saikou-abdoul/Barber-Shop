<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{

/*public function home()
{
    $user = Auth::user();
    $reservations = $user->reservations()->orderBy('date')->get();

    return view('client.home', [
        'user' => $user,
        'total' => $reservations->count(),
        'confirmées' => $reservations->where('status', 'confirmée')->count(),
        'attente' => $reservations->where('status', 'en attente')->count(),
        'prochaines' => $reservations->take(5),
    ]);
}
*/

/*public function home()
{
    return view('client.home');
}*/
public function home()
{
    $services = Service::actif()->get(); // ou simplement Service::all()
    return view('client.home', compact('services'));
}

}
