<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//         Gate::before(function ($user, $ability) {
//             if ($user->isSuperAdmin() || $user->isAdmin()) {
// //                dd($user->group->type);
//                 return true;
//             }
// // user-index // delete-usêr
//             return $user->group->roles()->where('name',$ability)->exists();
//         });
    }
}
