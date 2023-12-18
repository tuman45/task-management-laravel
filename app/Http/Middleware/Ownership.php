<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ownership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $resourceType)
    {
        $resource = $request->route($resourceType);
        logger('Resource Type: ' . $resourceType);
        logger('Route Parameters: ' . print_r($request->route()->parameters(), true));
        logger('Resource ID: ' . optional($resource)->id);
        logger('User ID: ' . auth()->user()->id);

        if ($resource && $resource->user_id == auth()->user()->id) {
            return $next($request);
        }

        abort(403, 'Unauthorized'); // User does not own the resource
    }
}
