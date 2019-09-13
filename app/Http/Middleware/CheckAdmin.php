<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        $rep = $next($request);

        if(auth('admin')->check()){
           $prefix = getPrefixeRoute($request->server());
           if ($prefix != 'admin') {
               return redirect()->route('admin.index');
           }
        }

        return $rep;
    }
}
