<?php

declare(strict_types=1);

namespace App\Services\User\Services;

use App\Services\User\Entity\CompanyDto;
use App\Services\User\Entity\CompanyModel;

final class Company implements CompanyService
{
    public function addCompany(int $userId, string $title, string $phone, string $description): bool
    {
        $company = new CompanyModel();
        $company->userId = $userId;
        $company->title = $title;
        $company->phone = $phone;
        $company->description = $description;

        return (bool) $company->save();
    }

    public function getUserCompanies(int $userId): array
    {
        $result = [];
        $user = \App\Models\User::find($userId);

        if (is_null($user)) {
            return [];
        }

        foreach ($user->companies as $company) {
            $result[] = $this->fillDto($company)->toArray();
        }

        return $result;
    }

    private function fillDto(CompanyModel $companyModel): CompanyDto
    {
        return new CompanyDto(
            (int) $companyModel->id,
            (int) $companyModel->userId,
            $companyModel->title,
            $companyModel->phone,
            $companyModel->description,
            $companyModel->created_at,
            $companyModel->updated_at
        );
    }
}
