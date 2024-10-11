<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthenticationsController extends Controller
{
    protected AuthenticationService $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login():View
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);

        if($credentials->fails()){
            return redirect()->back()->with("error", "Invalid credentials");
        }

         $response =  $this->authenticationService->login($request->email, $request->password);

        if($response['status'] == 400) {
            return redirect()->back()->with("error", "Invalid email or password");
        }


        return redirect()->intended(route('dashboard'))->with("success", "Logged in successfully");
    }




}
