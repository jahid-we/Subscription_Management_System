<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        if (!$token) {
            return redirect('/user-login')->with('error', 'Authentication token missing.');
        }

        $result = JWTToken::VerifyToken($token);

        if ($result === "unauthorized") {
            return redirect('/user-login')->with('error', 'Unauthorized access.');
        }

        // Dynamically set all verified data onto request headers
        foreach ((array) $result as $key => $value) {
            $request->headers->set($key, $value);
        }

        return $next($request);
    }
}
