<?php

namespace App\Http\Middleware;

protected $routeMiddleware = [
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
