<?php

namespace AvrilloCodeTest\AuthToken\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use AvrilloCodeTest\AuthToken\Token;

class TokenAuthenticated
{
    /**
     * Authenticate the token sent in the headers for the API.
     * 
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->bearerToken() === null || Token::check($request->bearerToken()) === false) {
            return response()->json('Unauthenticated.', 401);
        }
        return $next($request);
    }
}