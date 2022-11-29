<?php

namespace Orbtall\Intl\Middleware;

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

        $this->except = IgnoredRoute::get();

        foreach ($this->except as $except) {

            if ($except->route) {

                if ($except->route !== '/') {
                    $except_route = trim($except->route, '/');
                }

                if ($request->is($except_route)) {
                    return true;
                }

            }

        }

        return false;
    }

}
