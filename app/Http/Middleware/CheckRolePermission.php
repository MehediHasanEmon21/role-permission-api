<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePermission
{   
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {   
        $user = $request->user();
        $roles = $user->roles()->pluck('name')->toArray();
        
        foreach ($permissions as $per) {
            if ($user->hasRole($roles) && $user->permissions($per)) {
                return $next($request);
            }
        }

        return $this->responseError([], 'Access Denied', 403);

    }
}
