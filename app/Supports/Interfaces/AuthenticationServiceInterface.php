<?php

namespace App\Supports\Interfaces;
use Illuminate\Http\Request;

interface AuthenticationServiceInterface
{
    public function webLogin(string  $email, string $password): array;
    public function webLogout(Request $request);

  
    public function ApiLogin(string $email, bool $remember_me);

    public function getLoginUser(Request $request);
    public function ApiLogout(Request $request);

}
