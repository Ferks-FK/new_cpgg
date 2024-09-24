<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Installer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.installed')) {
            if ($request->routeIs('install*')) {
                abort(403, 'Application is already installed.');
            }
        } else {
            if (!$request->routeIs('install*')) {
                return redirect()->route('install');
            }
        }

        return $next($request);
    }
}
