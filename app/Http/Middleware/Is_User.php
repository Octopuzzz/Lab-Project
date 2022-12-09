<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Is_User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect(route('login'))->with('message', 'You Need To Login First !');
        }
        if ($request->user()->isAdmin != true) {
            return $next($request);
        } else if ($request->user()->isAdmin == true) {
            return redirect()->route('home')->with('message', "You Can't Access This Page !");
        }
        return $next($request);
    }
}
