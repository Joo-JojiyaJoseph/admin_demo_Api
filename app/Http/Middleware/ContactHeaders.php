<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next): Response
    {
        $customHeader = 'X-Contact-Header';
        $customValue = config('app.contact_header');
        if ($request->header($customHeader) !== $customValue) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
