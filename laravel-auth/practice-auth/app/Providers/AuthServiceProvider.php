<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('posts-create', function (User $user) {
            return ($user->roles === 1|| $user->roles === 3);
        });

        Gate::define('posts-index', function (User $user) {
            return ($user->roles === 2|| $user->roles === 3);
        });
        
        // Gate::define('posts-edit', function (User $user) {
        //     return $user->roles === 4;
        // });

        // Gate::define('posts-delete', function (User $user) {
        //     return $user->roles === 4;
        // });

    }
}