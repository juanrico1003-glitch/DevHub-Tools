<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    const ADMIN_EMAIL = 'juanrico1003@gmail.com';

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->email !== self::ADMIN_EMAIL) {
            abort(403, 'Acceso denegado. Esta sección es exclusiva del administrador.');
        }

        return $next($request);
    }
}
