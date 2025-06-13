<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RoleManagement;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $module, $permission)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $role = RoleManagement::find($user->role_id);
        if ($role && $role->hasPermission($module, $permission)) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}

