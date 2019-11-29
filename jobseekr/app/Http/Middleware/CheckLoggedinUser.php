<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckLoggedinUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();
        if (is_null($user)) {
            return redirect('/');
        }
        if ($user->role != $role) {
            return redirect('/');
        }
        return $next($request);
    }
}
