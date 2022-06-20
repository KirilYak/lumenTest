<?php

declare(strict_types=1);

namespace App\Services\Authenticator;

use Illuminate\Http\Request;

interface AuthenticatorService
{
    public function register(array $registerParams): bool;
    public function login(Request $request): ?array;
}
