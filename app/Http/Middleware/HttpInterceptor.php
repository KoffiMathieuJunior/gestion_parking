<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HttpInterceptor
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
        // Afficher la méthode de la requête et l'URI
        $method = $request->method();
        $uri = $request->path();
        Log::info("Méthode de la requête : $method, URI : $uri");

        // Afficher les en-têtes de la requête
        $headers = $request->headers->all();
        Log::info("En-têtes de la requête : ", $headers);

        // Continuer avec la requête suivante
        return $next($request);
    }
}
