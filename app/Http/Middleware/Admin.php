<?php

namespace App\Http\Middleware;

use Closure;

class Admin {
   public function handle($request, Closure $next) {
    if (auth()->user() &&  auth()->user()->role == 'Admin') {
        return $next($request);
    }  
        return redirect('/admin');
   }
}