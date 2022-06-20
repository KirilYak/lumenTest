<?php

namespace App\Services\User;

use App\Services\User\Entity\UserCreateEntity;

interface UserService
{
    public function create(UserCreateEntity $user): array;
    public function findByEmail(string $email): ?array;
    public function findByApiToken(string $apiToken): ?array;
    public function updateApiToken(int $userId): string;
    public function isPasswordsEqual(string $password, string $hashedPassword): bool;

    public function addCompany(int $userId, string $title, string $phone, string $description): bool;
    public function getUserCompanies(int $userId): array;
}
