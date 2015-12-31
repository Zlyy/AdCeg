<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class userSecurity
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
        
        $userid = intval($request->id);
        if($userid === Auth::id()) {
          return $next($request);
        }
        else {
            return redirect()->to('/');
        }
    }
}
