<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;
use App\Role;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // View::composer('*', function ($view) {
        //     $user = Auth::user();
        //     if ($user) {
        //         $role_id = $user->role_id->first();
        //         if ($role_id) {
        //             $role = $user->role($role_id->id);
        //             $view->with([
        //                 'user' => $user,
        //                 'role' => $role
        //             ]);
        //         }
        //     }
        // });
    }
}
