<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Authenticator\AuthenticatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    private AuthenticatorService $authenticatorService;

    public function __construct(AuthenticatorService $authenticatorService)
    {
        $this->authenticatorService = $authenticatorService;
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $this->authenticatorService->register($request->all());
            return response()->json();
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return response()->json(['message' => 'Wrong request'],400);
        }
    }
}
