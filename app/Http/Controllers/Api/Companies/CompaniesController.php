<?php

namespace App\Http\Controllers\Api\Companies;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CompaniesController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke()
    {
        try {
            return response()->json(
                $this->userService->getUserCompanies(Auth::id())
            );
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return response()->json(['message' => 'Wrong request'],400);
        }
    }
}
