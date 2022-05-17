<?php namespace App\Http\Middleware;

use Closure;
use Auth;
class Verification{

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->is_verify=='1')
        {
            return $next($request);
        }
          Auth::logout();
        return redirect('retype-email');

    }

}