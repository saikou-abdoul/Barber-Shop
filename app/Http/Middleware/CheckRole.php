<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
class CheckRole
{
   public function handle($request, Closure $next, ...$roles)
{
    $user = Auth::user();

    if (!$user || !$user->role) {
        abort(403);
    }

    if (!in_array($user->role->libelle, $roles)) {
        abort(403, 'Accès refusé.');
    }

    return $next($request);
}
   
}
   
   
   
   
   
   

   
   
   
   
   



