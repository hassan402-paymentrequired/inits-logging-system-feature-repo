<?php

namespace App\Supports\Interfaces;

interface AuthenticationServiceInterface
{
    public function login(string  $email, string $password): array;
}
