<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // ... existing middleware ...
        'role' => \App\Http\Middleware\CheckUserRole::class,
        'production.unit' => \App\Http\Middleware\CheckProductionUnitAccess::class,
    ];
} 