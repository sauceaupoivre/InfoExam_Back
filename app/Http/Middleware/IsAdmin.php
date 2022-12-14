<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if (\Auth::check()) {
            if (\Auth::user()->isadmin == 1) {
                return $next($request);
            }
            else {
                session()->flash('error', 'Il faut être admin');

                return redirect()->route('login');
            }
        }
        else {
            session()->flash('error', 'Il faut être admin');
            return redirect()->route('login');
        }
    }
}
