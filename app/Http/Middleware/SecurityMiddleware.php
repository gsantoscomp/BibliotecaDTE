<?php

namespace App\Http\Middleware;

use App\Repositories\SecurityRepository;
use Closure;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $securityRepository = new SecurityRepository();

        $routeName = $request->route()->getName();

        if ($securityRepository->hasPermission($routeName)) {
            return $next($request);
        }

        return redirect()->back();
    }
}
