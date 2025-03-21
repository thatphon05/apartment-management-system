<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next): RedirectResponse|Response|StreamedResponse
    {
        if (auth()->guard('admin')->user()) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        return to_route('admin.login.get');
    }
}
