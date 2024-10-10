<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class AuthenticationsController extends Controller
{
    protected AuthenticationService $authenticationService;
    public function __construct(AuthenticationService $authenticationService){
        $this->authenticationService = $authenticationService;
    }
    public function login()
    {
        return $this->respondWithCustomData(
            $this->authenticationService->login()
        );
    }
}
