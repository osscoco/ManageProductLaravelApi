<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return response()->json(['message' => 'Vous devez être connecté pour requêter cette url ...']);
        }

        if(Auth::user()->isAdmin() == false){
            return response()->json([
                'message' => 'Vous n\'avez pas les droits nécessaires pour requêter cette url ...'
            ]);
        }

        return $next($request);
    }
}
