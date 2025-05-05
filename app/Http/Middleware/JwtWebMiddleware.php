<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 如果用户已经通过 session 认证，则通过
        if ($request->user()) {
            return $next($request);
        }

        // 优先从 cookie 获取令牌
        $token = $request->cookie('jwt_token');

        if (!$token) {
            // 回退到 Authorization 头
            $bearerToken = $request->bearerToken();
            if ($bearerToken) {
                $token = $bearerToken;
            }
        }

        if (!$token) {
            return redirect()->route('login');
        }

        try {
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                return redirect()->route('login');
            }

            // 将用户信息存储在 Auth facade 中
            auth('api')->setUser($user);

            // 储存在请求中，以便 Inertia 中间件可以访问
            $request->attributes->add(['auth_user' => $user]);

        } catch (TokenExpiredException $e) {
            // 令牌已过期，尝试刷新
            try {
                $newToken = JWTAuth::refresh($token);
                JWTAuth::setToken($newToken);
                $user = JWTAuth::authenticate();

                if ($user) {
                    // 将用户信息存储在 Auth facade 中
                    auth('api')->setUser($user);

                    // 储存在请求中，以便 Inertia 中间件可以访问
                    $request->attributes->add(['auth_user' => $user]);

                    // 设置新令牌到 cookie，并允许请求继续
                    $response = $next($request);
                    return $response->cookie('jwt_token', $newToken, 60 * 24); // 24小时
                }
            } catch (JWTException $e) {
                return redirect()->route('login');
            }
        } catch (TokenInvalidException $e) {
            return redirect()->route('login');
        } catch (JWTException $e) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
