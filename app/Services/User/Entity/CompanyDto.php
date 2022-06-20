<?php

declare(strict_types=1);

namespace App\Services\User\Entity;

use Carbon\Carbon;

final class CompanyDto
{
    private int $id;
    private int $userId;
    private string $title;
    private string $phone;
    private string $description;
    private Carbon $created_at;
    private Carbon $updated_at;

    public function __construct(
        int $id,
        int $userId,
        string $title,
        string $phone,
        string $description,
        Carbon $created_at,
        Carbon $updated_at
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->phone = $phone;
        $this->description = $description;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'title' => $this->title,
            'phone' => $this->phone,
            'description' => $this->description,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
