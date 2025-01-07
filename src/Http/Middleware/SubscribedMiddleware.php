<?php

namespace RefBytes\Outseta\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubscribedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()?->subscribed()) {
            return redirect()->route(config('outseta.auth.redirect_if_not_subscribed'));
        }

        return $next($request);
    }
}
