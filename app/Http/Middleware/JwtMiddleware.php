<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
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
        try {
            // 尝试解析令牌并验证用户
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 401);
            }
        } catch (TokenExpiredException $e) {
            // 令牌已过期，尝试刷新
            try {
                $refreshedToken = JWTAuth::refresh(JWTAuth::getToken());
                $user = JWTAuth::setToken($refreshedToken)->authenticate();

                // 将新令牌放入响应中
                $response = $next($request);
                return $this->setAuthenticationHeader($response, $refreshedToken);
            } catch (JWTException $e) {
                return response()->json(['message' => 'Token cannot be refreshed, please login again'], 401);
            }
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Authorization token not found'], 401);
        }

        return $next($request);
    }

    /**
     * 将认证头添加到响应中
     *
     * @param  \Illuminate\Http\Response  $response
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    protected function setAuthenticationHeader($response, $token)
    {
        $response->headers->set('Authorization', 'Bearer ' . $token);
        return $response;
    }
}
