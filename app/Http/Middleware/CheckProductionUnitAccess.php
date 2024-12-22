<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProductionUnitAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $unitId = $request->route('unit');

        if (!$user->canAccessProductionUnit($unitId)) {
            abort(403, 'You do not have access to this production unit.');
        }

        return $next($request);
    }
} 