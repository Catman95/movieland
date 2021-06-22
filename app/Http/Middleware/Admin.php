<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->get('user')->role_id != 1) {
            return response()
                ->view('errors.404', ['data' => 1], 404)
                ->header('Content-Type', 'text/html');
        }
        return $next($request);
    }
}
