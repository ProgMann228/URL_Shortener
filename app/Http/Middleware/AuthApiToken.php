<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken(); //Токен из заголовка

        if(!$token){
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $user = app(UserService::class)->getUserByToken($token);

        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->user = $user;

        return $next($request);
    }
}
