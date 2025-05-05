<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

/**
 * @method \Tymon\JWTAuth\JWTGuard auth(string $guard = null)
 */

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'showLoginForm', 'showRegisterForm']]);
    }

    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    public function showRegisterForm()
    {
        return Inertia::render('Auth/Register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // 将令牌存储在 HTTP-only Cookie 中
        $cookie = cookie('jwt_token', $token, 60 * 24); // 24小时

        /** @var \Tymon\JWTAuth\JWTGuard $guard */
        $guard = auth('api');

        return response()->json([
            'user' => auth('api')->user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expires_in' => $guard->factory()->getTTL() * 60
            ]
        ])->withCookie($cookie);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('api')->login($user);

        // 将令牌存储在 HTTP-only Cookie 中
        $cookie = cookie('jwt_token', $token, 60 * 24); // 24小时

        /** @var \Tymon\JWTAuth\JWTGuard $guard */
        $guard = auth('api');

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expires_in' => $guard->getTTL() * 60
            ]
        ])->withCookie($cookie);
    }

    public function logout()
    {
        auth('api')->logout();

        // 清除 cookie
        $cookie = cookie()->forget('jwt_token');

        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }

    public function refresh()
    {

        /** @var \Tymon\JWTAuth\JWTGuard $guard */
        $guard = auth('api');

        return response()->json([
            'user' => $guard->user(),
            'authorization' => [
                'token' => $guard->refresh(),
                'type' => 'bearer',
                'expires_in' => $guard->factory()->getTTL() * 60
            ]
        ]);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }
}
