<?php

namespace Orbtall\Intl\Middleware;

use Closure;

class IntlRoutes extends IntlMiddlewareBase
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the URL of the request is in exceptions.
        if ($this->shouldIgnore($request)) {
            return $next($request);
        }

        $app = app();

        $routeName = $app['intl']->getRouteNameFromAPath($request->getUri());

        $app['intl']->setRouteName($routeName);

        return $next($request);
    }
}
