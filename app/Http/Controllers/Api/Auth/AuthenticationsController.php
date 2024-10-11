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
    public function authenticateUser(Request $request): JsonResponse
    {
        $credentials = Validator::make($request->all(), [
            //|exists:users,email
            "email" => "required|email",
            "password" => "required"
        ]);

        if($credentials->fails()){
            return $this->responseWithCustomError($credentials->errors());
        }


        return $this->respondWithCustomData(
            $this->authenticationService->login($request->email, $request->password)
        );
    }
}
