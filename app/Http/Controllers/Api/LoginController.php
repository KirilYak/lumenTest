<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Authenticator\AuthenticatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private AuthenticatorService $authenticatorService;

    public function __construct(AuthenticatorService $authenticatorService)
    {
        $this->authenticatorService = $authenticatorService;
    }

    public function __invoke(Request $request)
    {
        try {
            $loginData = $this->authenticatorService->login($request);

            if (!is_null($loginData)) {
                return response()->json($loginData);
            }

            return response()->json(['message' => 'User not exists'],400);

        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => 'Wrong request'],400);
        }
    }
}
