<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => function () use ($request) {
                    // 1. 首先检查请求属性中是否已经有用户（由jwt.web中间件设置）
                    if ($request->attributes->has('auth_user')) {
                        return $request->attributes->get('auth_user');
                    }

                    // 2. 然后检查是否通过 session 或 API 认证
                    if ($user = $request->user()) {
                        return $user;
                    }

                    if ($user = auth('api')->user()) {
                        return $user;
                    }

                    // 3. 最后尝试从 cookie 获取令牌并解析
                    $token = $request->cookie('jwt_token');

                    if ($token) {
                        try {
                            JWTAuth::setToken($token);
                            if ($user = JWTAuth::authenticate()) {
                                return $user;
                            }
                        } catch (JWTException $e) {
                            return null;
                        }
                    }

                    return null;
                }
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
        ]);
    }
}
