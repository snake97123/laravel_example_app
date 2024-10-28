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
    ];
}
