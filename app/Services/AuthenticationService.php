<?php

namespace App\Services;

use App\Models\User;
use App\Supports\Interfaces\AuthenticationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * @param string $email
     * @param  string $password
     * @return string[]
     * @return string $token
     */
    public function webLogin(string $email, string $password, bool $remember_me = false): array
    {
        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            return ['email' => 'The provided credentials are incorrect.', 'status' => 400];
        }


        Auth::login($user, $remember_me);

        return ["status" => 200];
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function webLogout(Request $request): void
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function ApiLogout(Request $request)
    {
        Auth::guard('api')->logout();
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        return [
            'message' => 'User logged out succefully'
        ];
    }

    public function ApiLogin(string $email, bool $remember_me = false)
    {
        $token = Auth::attempt([
            'email' => $email,
            'password' => 'password'
        ]);

        if (! $token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return [$token];
    }

    public function getLoginUser(Request $request)
    {
        return $request->user();
    }
}
