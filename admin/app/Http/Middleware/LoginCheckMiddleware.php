<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheckMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if($request->session()->has('user')){
            return $next($request);
        }else{
            return redirect('/');
        }
        
    }
}
