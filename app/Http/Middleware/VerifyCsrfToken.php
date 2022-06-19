<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // it is for postman check,
        // TODO delete it, when finish with it
        // TODO check how to make Patch work from postman
        '/users',
        '/users/*',
        'login',
        'logout',
        'post',
        'post/*',
    ];
}
