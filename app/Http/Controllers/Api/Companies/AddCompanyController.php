<?php

namespace App\Http\Controllers\Api\Companies;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddCompanyController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'phone' => 'required',
                'description' => 'required',
            ]);

            $result = $this->userService->addCompany(
                Auth::id(),
                $request->get('title'),
                $request->get('phone'),
                $request->get('description')
            );

            return response()->json($result);
        } catch (ValidationException $exception) {
            return response()->json($exception->getResponse()->original,400);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return response()->json(['message' => 'Wrong request'],400);
        }
    }
}
