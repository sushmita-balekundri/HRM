<?php

namespace App\Http\Middleware;

use Closure;

class Employee {
   public function handle($request, Closure $next) {
    if (auth()->user() &&  auth()->user()->role == 'Employee') {
        return $next($request);
    }  
        return redirect('/');
   }
}