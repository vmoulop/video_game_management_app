<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //$game = VideoGames::findOrFail($request->id);
        $user = auth()->user();
        
        if ( $user->role !== 'admin' && !$user->videoGames()->where('id',$request->id)->first()) {
            return response()->json([
                'message' => 'You do not have permission to perform this action.'
            ], 403);  // HTTP 403 Forbidden
        }
        
        return $next($request);
    }
}
