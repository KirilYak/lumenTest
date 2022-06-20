<?php

declare(strict_types=1);

namespace App\Services\User\Services;

use App\Services\User\Entity\UserDto;
use App\Services\User\UserService;
use App\Services\User\Entity\UserCreateEntity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User as UserModel;

final class User implements UserService
{
    private Company $companyService;

    public function __construct(Company $companyService)
    {
        $this->companyService = $companyService;
    }

    public function create(UserCreateEntity $userCreateEntity): array
    {
        $userModel = (new \App\Models\User($userCreateEntity->toArray()));
        $userModel['password'] = $this->hashPassword($userModel['password']);

        $userModel->save();

        return $this->fillDto($userModel)->toArray();
    }

    public function findByEmail(string $email): ?array
    {
        $user = UserModel::where('email','=', $email)->first();
        if (is_null($user)) {
            return null;
        }

        return $this->fillDto($user)->toArray();
    }

    public function findByApiToken(string $apiToken): ?array
    {
        $user = UserModel::where('api_token','=', $apiToken)->first();
        if (is_null($user)) {
            return null;
        }

        return $this->fillDto($user)->toArray();
    }

    public function updateApiToken(int $userId): string
    {
        $apiToken = $this->generateApiToken();
        UserModel::where('id', $userId)->update(['api_token' => $apiToken]);

        return $apiToken;
    }

    public function addCompany(int $userId, string $title, string $phone, string $description): bool
    {
        return $this->companyService->addCompany($userId, $title, $phone, $description);
    }

    public function getUserCompanies(int $userId): array
    {
        $result = [];
        $companies = $this->companyService->getUserCompanies($userId);
        foreach ($companies as $company) {
            $result[] = [
                'title' => $company['title'],
                'phone' => $company['phone'],
                'description' => $company['description'],
            ];
        }

        return $result;
    }

    public function isPasswordsEqual(string $password, string $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }

    private function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    private function generateApiToken(): string
    {
        return md5(Str::random(32) . time());
    }

    private function fillDto(\App\Models\User $userModel): UserDto
    {
        return (new UserDto($userModel->id))
            ->setEmail($userModel->email)
            ->setPassword($userModel->password)
            ->setFirstName($userModel->first_name)
            ->setLastName($userModel->last_name)
            ->setPhone($userModel->phone)
            ->setCreatedAt($userModel->created_at)
            ->setUpdatedAt($userModel->updated_at);
    }
}
