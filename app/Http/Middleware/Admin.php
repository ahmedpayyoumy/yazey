<?php namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin {

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->user_role=='1')
        {
            return $next($request);
        }

        return redirect('dashboard');

    }

}