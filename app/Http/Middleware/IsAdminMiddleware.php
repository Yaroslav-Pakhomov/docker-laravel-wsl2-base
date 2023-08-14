<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  dump($request->user()->toArray());
        // dd(auth()->user()->toArray());
        if ((int) auth()->user()->role === User::ROLE_GUEST) {
            return redirect()->back();
        }
        return $next($request);
    }
}
