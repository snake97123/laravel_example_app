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
        '/create/normalsql',
        '/update/normalsql',
        '/delete/normalsql',
        '/posts/create/bulk',
        '/posts/create/querybuilder',
        '/posts/get/querybuilder',
        '/posts/update/querybuilder',
        '/posts/delete/querybuilder/*',
        '/posts/get/querybuilderwithfilter',
        '/posts/get/querybuilder/count',
        '/posts/show/querybuilder/join',
        '/posts/get/querybuilder/find',
        '/posts/get/eloquent/create',
        '/posts/update/eloquent',
        '/posts/delete/eloquent/*',
    ];
}
