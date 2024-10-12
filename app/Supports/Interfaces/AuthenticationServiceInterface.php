<?php

namespace App\Supports\Interfaces;
use Illuminate\Http\Request;

interface AuthenticationServiceInterface
{
    public function login(string  $email, string $password): array;
    public function logout(Request $request);
}
