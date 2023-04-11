<?php

namespace App\Http\Middleware;

use App\Enums\UserStatusEnum;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ActiveUser
{
    public function handle(Request $request, Closure $next): RedirectResponse|Response|StreamedResponse
    {
        if (auth()->user()->status === UserStatusEnum::ACTIVE) {
            return $next($request);
        }

        auth()->logout();

        return to_route('user.login.get');
    }
}
