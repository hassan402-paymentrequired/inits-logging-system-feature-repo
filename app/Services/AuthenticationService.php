<?php

namespace App\Services;

use App\Supports\Interfaces\AuthenticationServiceInterface;

class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * @return string[]
     */
    public function login(): array
    {
        return [
            "You say?" => 'Yessssss'
        ];
    }
}
