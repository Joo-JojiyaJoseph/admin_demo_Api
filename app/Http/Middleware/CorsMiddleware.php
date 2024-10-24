<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        // Get the origin from the request
        $origin = $request->header('Origin');

        // List of allowed origins
        $allowedOrigins = [
            'https://www.test.capricornuae.com',
            'https://test.capricornuae.com',
            'http://localhost:5173'
        ];

        // Handle preflight requests
        if ($request->getMethod() === "OPTIONS") {
            return response()->json('OK', 200, [
                'Access-Control-Allow-Origin' => in_array($origin, $allowedOrigins) ? $origin : '',
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
                'Access-Control-Allow-Credentials' => 'true'
            ]);
        }

        // Handle actual requests
        return $next($request)
            ->header('Access-Control-Allow-Origin', in_array($origin, $allowedOrigins) ? $origin : '')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
