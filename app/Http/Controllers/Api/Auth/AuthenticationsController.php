<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationsController extends Controller
{
    protected AuthenticationService $authenticationService;
    public function __construct(AuthenticationService $authenticationService){
        $this->authenticationService = $authenticationService;
    }
    // public function authenticateUser(Request $request): JsonResponse
    // {
    //     $credentials = Validator::make($request->all(), [
    //         //|exists:users,email TODO: add exist check to email
    //         "email" => "required|email",
    //         "password" => "required"
    //     ]);

    //     if($credentials->fails()){
    //         return $this->responseWithCustomError($credentials->errors(), 400);
    //     }


    //     return $this->respondWithCustomData(
    //         $this->authenticationService->login($request->email, $request->password)
    //     );
    // }

    public function staffLogin(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            "email" => "required|email|exists:users,email",
        ]);

        if($credentials->fails()){
            return $this->responseWithCustomError($credentials->errors(), 400);
        }
        return $this->respondWithCustomData(
            $this->authenticationService->ApiLogin($request->email)
        );
    }


    public function logout(Request $request)
    {
          return  $this->authenticationService->ApiLogout($request);
  
    }

    public function getLoggedInUser(Request $request)
    {
        return $this->respondWithProxyData(
            $this->authenticationService->getLoginUser($request)
        );
    }
}
