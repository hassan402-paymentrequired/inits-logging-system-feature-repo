<?php

namespace App\Supports\Interfaces;

interface AuthenticationServiceInterface
{
    public function login(): array;
}
