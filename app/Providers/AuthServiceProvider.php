<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Reservation;
use App\Policies\ReservationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
   // protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
 //   ];
protected $policies = [
    Reservation::class => ReservationPolicy::class,
];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
