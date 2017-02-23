<?php

namespace App\Http\Middleware;

use Closure;
use \Session, \Redirect;

class PatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next)
    {
        if(!Session::has('PATIENT_ID')){
            return Redirect::route('user_login');
        }
        return $next($request);
    }
}
