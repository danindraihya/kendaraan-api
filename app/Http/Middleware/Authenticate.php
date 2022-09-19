<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Traits\ResponseApi;

class Authenticate extends Middleware
{
    use ResponseApi;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        abort($this->error("Unauthorized", 403));
        // if (! $request->expectsJson()) {
            // return route('login');
        // }
    }
}
