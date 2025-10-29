<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = 'admin';
        $password = env('PANEL_PASSWORD');

        if (
            !isset($_SERVER['PHP_AUTH_USER']) ||
            !isset($_SERVER['PHP_AUTH_PW']) ||
            $_SERVER['PHP_AUTH_USER'] !== $username ||
            $_SERVER['PHP_AUTH_PW'] !== $password
        ) {
            return response('Unauthorized.', 401, [
                'WWW-Authenticate' => 'Basic realm="Painel Administrativo"',
            ]);
        }

        return $next($request);
    }
}
