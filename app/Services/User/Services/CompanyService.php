<?php

namespace App\Services\User\Services;

interface CompanyService
{
    public function addCompany(int $userId, string $title, string $phone, string $description): bool;
    public function getUserCompanies(int $userId): array;
}
