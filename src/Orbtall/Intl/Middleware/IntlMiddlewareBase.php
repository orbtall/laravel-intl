<?php

namespace Orbtall\Intl\Middleware;

use Illuminate\Support\Facades\Schema;

use Orbtall\Intl\Models\IgnoredRoute;

class IntlMiddlewareBase {

    /**
     * The URIs that should not be localized.
     *
     * @var array
     */
    protected $except;

    /**
     * Determine if the request has a URI that should not be localized.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldIgnore($request) {

        if (in_array($request->method(), config('intl.httpMethodsIgnored'))) {
            return true;
        }

        if (Schema::hasTable('ignored_routes') && $this->configRepository->get('intl.driver') == 'database') {
            $this->except = IgnoredRoute::get();
        } else {
            $this->except = $this->except ?? config('laravellocalization.urlsIgnored', []);
        }

        foreach ($this->except as $except) {

            if ($except->route) {

                if ($except->route !== '/') {
                    $except_route = trim($except->route, '/');
                }

                if ($request->is($except_route)) {
                    return true;
                }

                $routes = explode('/', $except->route);

                foreach ($routes as $route) {

                    if ($route == '' || $route == '*') {
                        continue;
                    }

                    if ($request->is($route)) {
                        return true;
                    }

                }

            }

        }

        return false;
    }

}
