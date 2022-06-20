<?php

declare(strict_types=1);

namespace App\Services\Authenticator\Services;

use App\Services\Authenticator\AuthenticatorService;
use App\Services\User\Entity\UserCreateEntity;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

final class Authenticator implements AuthenticatorService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(array $params): bool
    {
        $userCreateEntity = (new UserCreateEntity($params['email'], $params['password']))
            ->setFirstName($params['first_name'] ?? '')
            ->setLastName($params['last_name'] ?? '')
            ->setPhone($params['phone'] ?? '');

        return (bool) $this->userService->create($userCreateEntity);
    }

    public function login(Request $request): ?array
    {
        $credentials = $request->only('email', 'password');

        Validator::validate($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->userService->findByEmail($credentials['email']);

        if (is_null($user)) {
            return null;
        }
        if ($this->userService->isPasswordsEqual($credentials['password'], $user['password'])) {
            $apiToken = $this->userService->updateApiToken($user['id']);
            return [
                'id' => $user['id'],
                'api_token' => $apiToken,
            ];
        }

        return null;
    }
}
