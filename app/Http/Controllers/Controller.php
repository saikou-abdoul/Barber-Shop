<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function authenticated(Request $request, $user)
{
    if ($user->isClient()) {
        return redirect()->route('client.home');
    }

    return redirect('/dashboard'); // autre route pour coiffeurs/admins
}
  
}
